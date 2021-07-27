<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings".
 * @property int $id
 * @property string $setting_name
 * @property string $setting_value
 * @property string $field_type
 * @property string $field_options
 * @property int $order
 * @property int $active
 */
class Settings extends \yii\db\ActiveRecord {
	
	public $logo;
	
	/**
	 * {@inheritdoc}
	 */
	public static function tableName(){
		return 'settings';
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['order', 'active'], 'integer'],
			[['setting_value', 'field_options'], 'string'],
			[['setting_name', 'field_type'], 'string', 'max' => 255],
		];
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(){
		return [
			'id'            => 'ID',
			'setting_name'  => 'Setting Name',
			'setting_value' => 'Setting Value',
			'field_type'    => 'Field Type',
			'field_options' => 'Field Options',
			'order'         => 'Field order',
			'active'        => 'Active',
		];
	}

	#public static function get
	
}
