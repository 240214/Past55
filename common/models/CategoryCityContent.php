<?php

namespace common\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\image\drivers\Image;
use yii\web\UploadedFile;
use yii\helpers\VarDumper;
use common\models\Category;
use common\models\State;
use common\models\City;

/**
 * This is the model class for table "category_city_content".
 * @property integer $id
 * @property integer $category_id
 * @property integer $state_id
 * @property integer $city_id
 * @property string $image
 * @property string $title
 * @property string $content
 * @property integer $active
 */

define('IMG_POSTS', \yii::getAlias('@frontend').'/web/images/3c/');

class CategoryCityContent extends ActiveRecord {
	
	public $categories = [];
	public $states = [];
	public $cities = [];
	public $cities_options = [];
	public $preview;
	private $image_updated = false;
	
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'category_city_content';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['title', 'category_id', 'state_id', 'city_id'], 'required'],
			[['id', 'category_id', 'state_id', 'city_id', 'active'], 'integer'],
			['content', 'string'],
			[['image', 'title'], 'string', 'max' => 255],
			['image', 'image', 'skipOnEmpty' => true, 'extensions' => Yii::$app->params['image_exts'], 'maxFiles' => 1],
		
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'category_id'  => Yii::t('app', 'Category'),
			'state_id'     => Yii::t('app', 'State'),
			'city_id'      => Yii::t('app', 'City'),
			'image'        => Yii::t('app', 'Image'),
			'title'        => Yii::t('app', 'Title'),
			'content'      => Yii::t('app', 'Content'),
			'active'     => Yii::t('app', 'Post status'),
			'categoryName' => Yii::t('app', 'Category'),
			'stateName'    => Yii::t('app', 'State'),
			'cityName'     => Yii::t('app', 'City'),
		];
	}
	
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory(){
		return $this->hasOne(Category::className(), ['id' => 'category_id']);
	}
	
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getState(){
		return $this->hasOne(State::className(), ['id' => 'state_id']);
	}
	
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCity(){
		return $this->hasOne(City::className(), ['id' => 'city_id']);
	}
	
	public function getCategories(){
		if(empty($this->categories)){
			$list = Category::find()->orderBy('name ASC')->all();
			
			$this->categories = ArrayHelper::map($list, 'id', 'name');
		}
		
		return $this->categories;
	}
	
	public function getFilterCategories(){
		$list = [];
		
		$results = Category::find()->all();
		
		foreach($results as $result){
			$list[$result->name] = $result->name;
		}
		
		return $list;
	}
	
	public function getStates(){
		if(empty($this->states)){
			$list = State::find()->orderBy('name ASC')->all();
			
			$this->states = ArrayHelper::map($list, 'id', 'name');
		}
		
		return $this->states;
	}
	
	public function getFilterStates(){
		$list = [];
		
		$results = State::find()->all();
		
		foreach($results as $result){
			$list[$result->name] = $result->name;
		}
		
		return $list;
	}
	
	public function getCities(){
		if(empty($this->cities)){
			$list = City::find()
			            ->where(['not', ['name' => null]])
			            ->orWhere(['not', ['name' => '']])
			            ->orderBy('name ASC')->all();
			
			$this->cities[0] = '---';
			$this->cities += ArrayHelper::map($list, 'id', 'name');
		}
		
		return $this->cities;
	}
	
	public function getFilterCities(){
		$list = [];
		
		$results = City::find()->all();
		
		foreach($results as $result){
			$list[$result->name] = $result->name;
		}
		
		return $list;
	}
	
	public function getCitiesOptions(){
		if(empty($this->cities_options)){
			$list = City::find()->orderBy('name ASC')->all();
			
			$options = [];
			$options[0] = ['class' => 'empty-value'];
			
			foreach($list as $item)
				if(!empty($item->name))
					$options[$item->id] = ['class' => 'hidden', 'data-state_id' => $item->state_id];
			
			
			$this->cities_options = $options;
		}
		
		return $this->cities_options;
	}
	
	public function FormatedTitle(){
		return str_replace(['%CATEGORY%', '%STATE%', '%CITY%'], [$this->category->name, $this->state->name, $this->city->name], $this->title);
	}
	
	public function uploadLogo(){
		$name = rand(137, 999).time();
		$this->image->saveAs(IMG_POSTS.$name.'.'.$this->image->extension);
		
		return $name.'.'.$this->image->extension;
	}
	
	public function beforeSave($insert){
		
		if(!$this->image_updated && !$insert){
			$this->saveImages($insert);
		}
		
		return parent::beforeSave($insert);
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);

		if($insert){
			$this->saveImages($this->category_id, $insert);
		}
	}
	
	private function saveImages($insert){
		#Yii::info(__CLASS__.' > '.__FUNCTION__, 'past55');
		
		$dir = Yii::getAlias('@3c_images').'/'.$this->id;
		
		if(!is_dir($dir)){
			FileHelper::createDirectory($dir, 0777);
			FileHelper::createDirectory($dir.'/thumbs', 0777);
		}
		
		if($file = UploadedFile::getInstance($this, 'preview')){
			#Yii::info($file, 'past55');
			
			if(!$insert && !empty($this->image) && file_exists($dir.'/'.$this->image) && is_file($dir.'/'.$this->image)){
				FileHelper::unlink($dir.'/'.$this->image);
				
				foreach(Yii::$app->params['image_sizes'] as $name => $size){
					$replace_fragment = [];
					if(!is_null($size['w'])) $replace_fragment[] = $size['w'];
					if(!is_null($size['h'])) $replace_fragment[] = $size['h'];
					$replace_fragment = implode('_', $replace_fragment);
					
					$image = str_replace('.'.$file->extension, '_'.$replace_fragment.'.'.$file->extension, $this->image);
					
					if(file_exists($dir.'/thumbs/'.$image) && is_file($dir.'/thumbs/'.$image)){
						FileHelper::unlink($dir.'/thumbs/'.$image);
					}
				}
			}
			
			$this->image = $this->id.'_'.time().'_'.rand(137, 999).'.'.$file->extension;
			
			$file->saveAs($dir.'/'.$this->image);
			
			foreach(Yii::$app->params['image_sizes'] as $name => $size){
				$replace_fragment = [];
				if(!is_null($size['w'])) $replace_fragment[] = $size['w'];
				if(!is_null($size['h'])) $replace_fragment[] = $size['h'];
				$replace_fragment = implode('_', $replace_fragment);
				
				$image = Yii::$app->image->load($dir.'/'.$this->image);
				$image->background('#fff', 0);
				$image->resize($size['w'], $size['h'], $size['crop']);
				$image->save($dir.'/thumbs/'.str_replace('.'.$file->extension, '_'.$replace_fragment.'.'.$file->extension, $this->image), 90);
			}
			
			$this->image_updated = true;
		}
		
		if($insert){
			$this->save();
		}
	}
	
	public function getMainImage($size = '250'){
		$image = Yii::$app->urlManagerFrontend->baseUrl.'/images/common/noimage.svg';
		
		if($this->image){
			$pathinfo = pathinfo($this->image);
			if($size == 'full' || $size == ''){
				$file_name = $pathinfo['filename'].'.'.$pathinfo['extension'];
				$file = $this->id.'/'.$file_name;
			}else{
				$file_name = $pathinfo['filename'].'_'.$size.'.'.$pathinfo['extension'];
				$file = $this->id.'/thumbs/'.$file_name;
			}
			
			if(file_exists(Yii::getAlias('@3c_images').'/'.$file)){
				$image = Yii::$app->urlManagerFrontend->baseUrl.'/images/3c/'.$file;
			}
		}
		
		return $image;
	}
	
	
}
