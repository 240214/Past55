<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property string $icon
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $template
 */
class Category extends ActiveRecord{
	
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
			[['name'], 'required'],
			[['type', 'slug', 'meta_title', 'meta_keywords', 'meta_description', 'template'], 'string'],
			[['name', 'icon'], 'string', 'max' => 225],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'id'               => Yii::t('app', 'ID'),
			'name'             => Yii::t('app', 'Name'),
			'slug'             => Yii::t('app', 'Slug'),
			'type'             => Yii::t('app', 'Type'),
			'icon'             => Yii::t('app', 'Icon'),
			'meta_title'       => Yii::t('app', 'Meta Title & H1'),
			'meta_keywords'    => Yii::t('app', 'Meta Keywords'),
			'meta_description' => Yii::t('app', 'Meta Description'),
			'template' => Yii::t('app', 'Template'),
		];
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
	
	
}
