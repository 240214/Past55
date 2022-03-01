<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\Country;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

/**
 * State model
 * @property string $name
 * @property string $iso_code
 * @property string $country_id
 */
class State extends ActiveRecord{
	
	public $countries = [];
	
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'states';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			['name', 'safe'],
			['iso_code', 'safe'],
			['country_id', 'safe'],
		
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'id'         => Yii::t('app', 'ID'),
			'name'       => Yii::t('app', 'Name'),
			'iso_code'       => Yii::t('app', 'ISO Code'),
			'country_id' => Yii::t('app', 'Country'),
		];
	}
	
	public static function namebyid($id){
		$state = static::findOne($id);
		
		return $state['name'];
	}
	
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCountry(){
		return $this->hasOne(Country::className(), ['id' => 'country_id']);
	}
	
	public function getCountries(){
		if(empty($this->countries)){
			$list = Country::find()->orderBy('name ASC')->all();
			
			$this->countries = ArrayHelper::map($list, 'id', 'name');
		}
		
		return $this->countries;
	}
	
	public static function getIDByIso($iso){
		$id = 0;
		
		$result = self::find()->select('id')->where(['iso_code' => $iso])->asArray()->one();
		
		if(!is_null($result))
			$id = intval($result['id']);
		
		return $id;
	}
	
	public static function getStatesIsoNameList(){
		$model = self::find()->select('iso_code, name')->orderBy('iso_code ASC')->all();
		
		return ArrayHelper::map($model, 'iso_code', 'name');
	}
	
	public static function getStatesNameIsoList(){
		$model = self::find()->select('name, iso_code')->orderBy('iso_code ASC')->all();
		
		return ArrayHelper::map($model, 'name', 'iso_code');
	}
	
	public static function getStatesIsoByName($name){
		$model = self::find()->select('iso_code')->where(['name' => $name])->one();
		
		return $model->iso_code;
	}
	
	public static function getStateByName($name){
		$data = self::find()->where(['name' => $name])->asArray()->one();
		
		return $data;
	}
	
	public static function getStatesSlugIDList(){
		$model = self::find()->select('id, slug')->orderBy('slug ASC')->all();
		
		return ArrayHelper::map($model, 'slug', 'id');
	}
	
}
