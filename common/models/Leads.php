<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "leads".
 * @property integer $id
 * @property string $sender
 * @property integer $phone
 * @property string $email
 * @property string $message
 * @property integer $created_at
 */
class Leads extends ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'leads';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['sender', 'phone', 'email', 'message'], 'required'],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	
}
