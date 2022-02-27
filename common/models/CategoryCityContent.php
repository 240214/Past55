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
 * @property integer $category_id
 * @property integer $state_id
 * @property integer $city_id
 * @property string $image
 * @property string $title
 * @property string $content
 */

define('IMG_POSTS', \yii::getAlias('@frontend').'/web/images/3c/');

class CategoryCityContent extends ActiveRecord {
	
	public $categories = [];
	public $states = [];
	public $cities = [];
	public $preview;
	public $image_exts = 'gif, png, jpg, jpeg';
	public $image_sizes = [
		'thumb' => 250,
		'mob_small' => 575,
		'mob_big' => 767,
	];
	
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
			[['category_id', 'state_id', 'city_id'], 'required'],
			[['category_id', 'state_id', 'city_id'], 'integer'],
			['content', 'string'],
			[['image', 'title'], 'string', 'max' => 255],
			['image', 'image', 'skipOnEmpty' => true, 'extensions' => $this->image_exts, 'maxFiles' => 1],
		
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'category_id' => Yii::t('app', 'Category'),
			'state_id' => Yii::t('app', 'State'),
			'city_id' => Yii::t('app', 'City'),
			'image'  => Yii::t('app', 'Image'),
			'title' => Yii::t('app', 'Title'),
			'content'  => Yii::t('app', 'Content'),
		];
	}
	
	public function getCategory(){
		return $this->hasOne(Category::className(), ['id' => 'category_id']);
	}
	
	public function getState(){
		return $this->hasOne(State::className(), ['id' => 'state_id']);
	}
	
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
	
	public function getStates(){
		if(empty($this->states)){
			$list = State::find()->orderBy('name ASC')->all();
			
			$this->states = ArrayHelper::map($list, 'id', 'name');
		}
		
		return $this->states;
	}
	
	public function getCities(){
		if(empty($this->cities)){
			$list = City::find()->orderBy('name ASC')->all();
			
			$this->cities = ArrayHelper::map($list, 'id', 'name');
		}
		
		return $this->cities;
	}
	
	public function uploadLogo(){
		$name = rand(137, 999).time();
		$this->image->saveAs(IMG_POSTS.$name.'.'.$this->image->extension);
		
		return $name.'.'.$this->image->extension;
	}
	
	public function beforeSave($insert){
		
		if(!$insert){
			$id = intval(Yii::$app->request->get('id'));
			$this->saveImages($id, $insert);
		}
		
		return parent::beforeSave($insert);
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);

		if($insert){
			
			$this->saveImages($this->category_id, $insert);
		}
	}
	
	private function saveImages($id = 0, $insert){
		if($id == 0) return;
		
		$dir = Yii::getAlias('@posts_images').'/'.$id;
		
		if(!is_dir($dir)){
			FileHelper::createDirectory($dir, 0777);
			FileHelper::createDirectory($dir.'/thumbs', 0777);
		}
		
		if($file = UploadedFile::getInstance($this, 'preview')){
			#VarDumper::dump($file, 10, 1); exit;
			if(file_exists($dir.'/'.$this->image) && is_file($dir.'/'.$this->image)){
				FileHelper::unlink($dir.'/'.$this->image);
			}
			if(file_exists($dir.'/thumbs/'.$this->image) && is_file($dir.'/thumbs/'.$this->image)){
				FileHelper::unlink($dir.'/thumbs/'.$this->image);
			}
			
			$this->image = $id.'_'.time().'_'.rand(137, 999).'.'.$file->extension;
			
			$file->saveAs($dir.'/'.$this->image);
			
			foreach($this->image_sizes as $name => $size){
				$image = Yii::$app->image->load($dir.'/'.$this->image);
				$image->background('#fff', 0);
				$image->resize($size, null, Image::INVERSE);
				$image->save($dir.'/thumbs/'.str_replace('.'.$file->extension, '_'.$size.'.'.$file->extension, $this->image), 90);
			}
		}
		
		if($insert){
			$this->save();
		}
	}
	
	public function getMainImage($size = '250'){
		$image = Yii::$app->urlManagerFrontend->baseUrl.'/images/3c/nophoto.svg';
		
		if($this->image){
			$pathinfo = pathinfo($this->image);
			if($size == 'full' || $size == ''){
				$file_name = $pathinfo['filename'].'.'.$pathinfo['extension'];
				$file = $this->id.'/'.$file_name;
			}else{
				$file_name = $pathinfo['filename'].'_'.$size.'.'.$pathinfo['extension'];
				$file = $this->id.'/thumbs/'.$file_name;
			}
			
			if(file_exists(Yii::getAlias('@posts_images').'/'.$file)){
				$image = Yii::$app->urlManagerFrontend->baseUrl.'/images/3c/'.$file;
			}
		}
		
		return $image;
	}
	
	
}