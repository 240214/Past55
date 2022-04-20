<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "settings".
 * @property int $id
 * @property string $setting_name
 * @property string $setting_value
 * @property string $field_type
 * @property string $field_options
 * @property string $setting_title
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
			[['setting_name', 'field_type', 'setting_title'], 'string', 'max' => 255],
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
			'setting_title' => 'Setting Title',
			'order'         => 'Field order',
			'active'        => 'Active',
		];
	}

	public static function getSettings(){
		$data = Settings::find()->asArray()->all();
		$settings = ArrayHelper::map($data, 'setting_name', 'setting_value');
		#$a = explode(' ', $settings['site_name']);
		#$settings['site_short_name'] = $a[0][0].$a[1][0];
		$settings['site_short_name'] = "GC";
		
		return $settings;
	}
	
}
