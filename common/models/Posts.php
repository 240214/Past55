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


/**
 * This is the model class for table "posts".
 * @property integer $id
 * @property integer $user_id
 * @property string $image
 * @property string $title
 * @property string $content
 * @property string $meta_description
 * @property string $slug
 * @property string $type
 * @property integer $category_id
 * @property integer $created_at
 */

define('IMG_POSTS', \yii::getAlias('@frontend').'/web/images/posts/');

class Posts extends ActiveRecord {
	
	public $categories = [];
	public $types = [
		'post' => 'Blog Post',
		'article' => 'Category Article',
	];
	public $preview;
	
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'posts';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['title', 'content'], 'required'],
			[['user_id', 'category_id'], 'integer'],
			['content', 'string'],
			[['type'], 'string', 'max' => 10],
			[['image', 'title', 'meta_description', 'slug'], 'string', 'max' => 255],
			['created_at', 'safe'],
			['image', 'image', 'skipOnEmpty' => true, 'extensions' => Yii::$app->params['image_exts'], 'maxFiles' => 1],
		
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'id' => Yii::t('app', 'ID'),
			'user_id' => Yii::t('app', 'User'),
			'image' => Yii::t('app', 'Image'),
			'title' => Yii::t('app', 'Title'),
			'content'  => Yii::t('app', 'Content'),
			'meta_description'  => Yii::t('app', 'Meta desctiption'),
			'slug'  => Yii::t('app', 'Slug'),
			'type'  => Yii::t('app', 'Post type'),
			'category_id'  => Yii::t('app', 'Category'),
			'created_at'  => Yii::t('app', 'Created at'),
		];
	}
	
	public function getCategory(){
		return $this->hasOne(Category::className(), ['id' => 'category_id']);
	}
	
	public function getCategories(){
		if(empty($this->categories)){
			$listCategory = Category::find()->orderBy('name ASC')->all();
			
			$this->categories = ArrayHelper::map($listCategory, 'id', 'name');
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
	
	public function getTypes(){
		return $this->types;
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
			$this->saveImages($this->id, $insert);
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
			
			foreach(Yii::$app->params['image_sizes'] as $name => $size){
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
		$image = Yii::$app->urlManagerFrontend->baseUrl.'/images/posts/nophoto.svg';
		
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
				$image = Yii::$app->urlManagerFrontend->baseUrl.'/images/posts/'.$file;
			}
		}
		
		return $image;
	}
	
	
}
