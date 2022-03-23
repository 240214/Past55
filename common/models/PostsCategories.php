<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string  $title
 * @property string  $slug
 */
class PostsCategories extends ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'posts_categories';
	}
	
	public function rules(){
		return [
			[['title', 'slug'], 'required'],
			[['title', 'slug'], 'string', 'max' => 255],
		
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Title'),
			'slug'  => Yii::t('app', 'Slug'),
		];
	}
	
	public function getPosts(){
		return $this->hasMany(Posts::className(), ['post_category_id' => 'id']);
	}
	
}
