<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 * @property integer $id
 * @property integer $property_id
 * @property integer $user_id
 * @property string $sid
 */
class FavoriteProperties extends ActiveRecord{
	
	public $active = false;
	public $property = null;
	
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'favorite_properties';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['id', 'user_id', 'property_id'], 'integer'],
			[['sid'], 'string'],
			[['id', 'user_id', 'property_id', 'sid'], 'safe'],
		];
	}
	
	
}
