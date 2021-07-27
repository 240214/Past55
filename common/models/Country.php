<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Country model
 * @property string $iso_code
 * @property string $name
 * @property string $phonecode
 * @property string $id
 */
class Country extends ActiveRecord{
	
	
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'countries';
	}
	
	/**
	 * @inheritdoc
	 */
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			['iso_code', 'safe'],
			['name', 'safe'],
			['phonecode', 'safe'],
			['city', 'safe'],
		
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'id'        => Yii::t('app', 'ID'),
			'name'      => Yii::t('app', 'Name'),
			'iso_code'  => Yii::t('app', 'ISO Code'),
			'phonecode' => Yii::t('app', 'Phone Code'),
		];
	}
	
	public static function GetNameById($id){
		$country = static::find()->where(['id' => $id])->one();
		
		return $country['name'];
	}
	
	
}
