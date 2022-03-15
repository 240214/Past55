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
use common\models\Users;


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
 * @property string $ccl_title
 * @property string $content_list
 * @property integer $created_at
 */

class Posts extends ActiveRecord {
	
	public $category_list = [];
	public $users_list = [];
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
			[['title', 'ccl_title', 'content'], 'required'],
			[['user_id', 'category_id'], 'integer'],
			[['content', 'content_list'], 'string'],
			[['type'], 'string', 'max' => 10],
			[['image', 'title', 'meta_description', 'slug', 'ccl_title'], 'string', 'max' => 255],
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
			'user_id' => Yii::t('app', 'Author'),
			'image' => Yii::t('app', 'Image'),
			'title' => Yii::t('app', 'Title'),
			'content'  => Yii::t('app', 'Content'),
			'meta_description'  => Yii::t('app', 'Meta desctiption'),
			'slug'  => Yii::t('app', 'Slug'),
			'type'  => Yii::t('app', 'Post type'),
			'category_id'  => Yii::t('app', 'Category'),
			'created_at'  => Yii::t('app', 'Created at'),
			'ccl_title'  => Yii::t('app', 'Title for Category content list'),
			'content_list'  => Yii::t('app', 'Post Content list'),
		];
	}
	
	public function getUsers(){
		return $this->hasOne(Users::className(), ['id' => 'user_id']);
	}
	
	public function getUsersList(){
		if(empty($this->users_list)){
			$list = Users::find()->orderBy('name ASC')->all();
			
			$this->users_list = ArrayHelper::map($list, 'id', 'name');
		}
		
		return $this->users_list;
	}
	
	public function getCategory(){
		return $this->hasOne(Category::className(), ['id' => 'category_id']);
	}
	
	public function getCategoriesList(){
		if(empty($this->category_list)){
			$list = Category::find()->orderBy('name ASC')->all();
			
			$this->category_list = ArrayHelper::map($list, 'id', 'name');
		}
		
		return $this->category_list;
	}
	
	public function getTypes(){
		return $this->types;
	}
	
	public function getShortDescription($length = 77){
		$_text = strip_tags($this->content);
		if(mb_strlen($_text, 'utf-8') <= $length){
			return $_text;
		}
		
		$_text = trim($_text, ".,?:><;");
		$a = explode(' ', $_text);
		
		$r = '';
		$n = [];
		foreach($a as $k => $t){
			$r .= $t.' ';
			if(mb_strlen($r, 'utf-8') >= $length){
				continue;
			}else{
				$n[$k] = $t;
			}
		}
		
		return implode(' ', $n).'...';
	}
	
	public function beforeSave($insert){
		
		if(!$insert){
			$this->saveImages($insert);
		}
		
		return parent::beforeSave($insert);
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);

		if($insert){
			$this->saveImages($insert);
		}
	}
	
	private function saveImages($insert){
		
		$dir = Yii::getAlias('@posts_images').'/'.$this->id;
		
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
			
			$this->image = $this->id.'_'.time().'_'.rand(137, 999).'.'.$file->extension;
			
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
			
			if(file_exists(Yii::getAlias('@posts_images').'/'.$file)){
				$image = Yii::$app->urlManagerFrontend->baseUrl.'/images/posts/'.$file;
			}
		}
		
		return $image;
	}
	
	
}
