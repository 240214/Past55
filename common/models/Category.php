<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "category".
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $h1_title
 * @property string $h1_title_for_state
 * @property string $h1_title_for_state_city
 * @property string $slug
 * @property string $type
 * @property string $icon
 * @property string $meta_title
 * @property string $meta_for_title_state
 * @property string $meta_for_title_state_city
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
			[['type', 'slug', 'h1_title', 'h1_title_for_state', 'h1_title_for_state_city', 'meta_title', 'meta_title_for_state', 'meta_title_for_state_city', 'meta_keywords', 'meta_description', 'template', 'content_list'], 'string'],
			[['name', 'h1_title', 'icon'], 'string', 'max' => 225],
			['created_at', 'safe'],
			[['name', 'slug'], 'trim'],
			['slug', 'unique', 'message' => 'This slug has already been taken. Please enter a different slug.'],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'id'               => Yii::t('app', 'ID'),
			'name'             => Yii::t('app', 'Name'),
			'h1_title'             => Yii::t('app', 'H1 Title'),
			'h1_title_for_state'             => Yii::t('app', 'H1 Title for State'),
			'h1_title_for_state_city'             => Yii::t('app', 'H1 Title for State & City'),
			'slug'             => Yii::t('app', 'Slug'),
			'type'             => Yii::t('app', 'Type'),
			'icon'             => Yii::t('app', 'Icon'),
			'meta_title'       => Yii::t('app', 'Meta Title'),
			'meta_title_state'       => Yii::t('app', 'Meta Title for State'),
			'meta_title_state_city'       => Yii::t('app', 'Meta Title for State & City'),
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
		
		if(!isset($params['empty'])) $params['empty'] = true;
		
		$fields = $params['fields'];
		foreach($fields as $k => $field)
			$fields[$k] = 'category.'.$field;
		
		if(!$params['empty']){
			$models = self::find()
				->join('RIGHT JOIN', 'properties', 'properties.category_id = category.id')
				->select(implode(',', $fields))
				->groupBy(['category.id'])
				->orderBy($params['order'])->all();
		}else{
			$models = self::find()
				->select(implode(',', $fields))
				->orderBy($params['order'])->all();
		}
		#VarDumper::dump($models, 10, 1);exit;

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
