<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use common\models\State;

/**
 * City model
 * @property string $name
 * @property string $state_id
 */
class City extends ActiveRecord{
	
	public $states = [];
	
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'cities';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			['name', 'safe'],
			['state_id', 'safe'],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'id'       => Yii::t('app', 'ID'),
			'name'     => Yii::t('app', 'Name'),
			'state_id' => Yii::t('app', 'State'),
		];
	}
	
	
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getState(){
		return $this->hasOne(State::className(), ['id' => 'state_id']);
	}
	
	public function getStates(){
		if(empty($this->states)){
			$list = State::find()->orderBy('name ASC')->all();
			
			$this->states = ArrayHelper::map($list, 'id', 'name');
		}
		
		return $this->states;
	}
	
}
