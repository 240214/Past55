<?php

namespace common\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;


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
 * @property integer $comment_id
 * @property integer $created_at
 */

define('IMG_POSTS', \yii::getAlias('@frontend').'/web/images/posts/');

class Posts extends ActiveRecord {
	
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
			[['comment_id', 'user_id', 'category_id'], 'integer'],
			['content', 'string'],
			[['type'], 'string', 'max' => 10],
			[['image', 'title', 'meta_description', 'slug'], 'string', 'max' => 255],
			['created_at', 'safe'],
			['image', 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxWidth' => 960, 'minWidth' => 960, 'maxHeight' => 520, 'minHeight' => 520, 'maxFiles' => 1],
		
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'id' => Yii::t('app', 'ID'),
			'user_id' => Yii::t('app', 'User ID'),
			'image' => Yii::t('app', 'Image'),
			'title' => Yii::t('app', 'Title'),
			'content'  => Yii::t('app', 'Content'),
			'meta_description'  => Yii::t('app', 'Meta desctiption'),
			'slug'  => Yii::t('app', 'Slug'),
			'type'  => Yii::t('app', 'Type'),
			'category_id'  => Yii::t('app', 'Category ID'),
			'created_at'  => Yii::t('app', 'Created at'),
		];
	}
	
	public function uploadLogo(){
		$name = rand(137, 999).time();
		$this->image->saveAs(IMG_POSTS.$name.'.'.$this->image->extension);
		
		return $name.'.'.$this->image->extension;
	}
	
	
}
