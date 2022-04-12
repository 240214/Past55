<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $title
 * @property string $slug
 * @property string $type
 * @property string $icon
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $template
 * @property string $content_list
 * @property integer $created_at
 */
class Category extends ActiveRecord{
	
	public $users_list = [];
	public $users;
	
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'category';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['name', 'user_id'], 'required'],
			[['type', 'slug', 'title', 'meta_title', 'meta_keywords', 'meta_description', 'template', 'content_list'], 'string'],
			[['name', 'title', 'icon'], 'string', 'max' => 225],
			['created_at', 'safe'],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'id'               => Yii::t('app', 'ID'),
			'name'             => Yii::t('app', 'Name'),
			'title'             => Yii::t('app', 'H1 Title'),
			'slug'             => Yii::t('app', 'Slug'),
			'type'             => Yii::t('app', 'Type'),
			'icon'             => Yii::t('app', 'Icon'),
			'meta_title'       => Yii::t('app', 'Meta Title'),
			'meta_keywords'    => Yii::t('app', 'Meta Keywords'),
			'meta_description' => Yii::t('app', 'Meta Description'),
			'template' => Yii::t('app', 'Template'),
			'content_list' => Yii::t('app', 'Content List'),
			'user_id' => Yii::t('app', 'User'),
		];
	}
	
	public function getUsers(){
		return $this->hasOne(Users::className(), ['id' => 'user_id']);
	}
	
	public function getProperties(){
		return $this->hasMany(Property::className(), ['category_id' => 'id']);
	}
	
	public function getPosts(){
		return $this->hasMany(Posts::className(), ['category_id' => 'id']);
	}
	
	public static function getCategoryList($params){
		$ret = [];
		
		$models = self::find()->select(implode(',', $params['fields']))->orderBy($params['order'])->all();
		
		if($models){
			foreach($models as $model){
				foreach($params['fields'] as $field){
					$ret[$model->{$params['key_field']}][$field] = $model->{$field};
				}
			}
		}
		
		return $ret;
	}
	
	public static function getCategoryBySlug($slug){
		return self::find()->where(['slug' => $slug])->asArray()->one();
	}
	
	public function getUsersList(){
		if(empty($this->users_list)){
			$list = Users::find()->orderBy('name ASC')->all();
			
			$this->users_list = ArrayHelper::map($list, 'id', 'name');
		}
		
		return $this->users_list;
	}
	
	
}
