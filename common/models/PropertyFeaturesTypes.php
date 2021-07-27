<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "property_features_types".
 * @property int $id
 * @property string $title
 * @property integer $order
 * @property integer $separated
 * @property string $section_title
 * @property string $section_description
 */
class PropertyFeaturesTypes extends ActiveRecord{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName(){
		return 'property_features_types';
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['title', 'section_title'], 'string', 'max' => 255],
			[['section_description'], 'string'],
			[['order', 'separated'], 'number'],
		];
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(){
		return [
			'id'    => 'ID',
			'title' => 'Title',
			'order' => 'Order',
			'separated' => 'Display as separated section in сomparison page',
			'section_title' => 'Section title in сomparison page',
			'section_description' => 'Section description in сomparison page',
		];
	}
}
