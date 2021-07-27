<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "nearby_places_types".
 * @property int $id
 * @property string $name
 * @property string $label
 * @property int $active
 */
class NearbyPlacesTypes extends ActiveRecord {
	
	/**
	 * {@inheritdoc}
	 */
	public static function tableName(){
		return 'nearby_places_types';
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['active'], 'integer'],
			[['name', 'label'], 'string', 'max' => 40],
		];
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(){
		return [
			'id'     => 'ID',
			'name'   => 'Name',
			'label'  => 'Label',
			'active' => 'Active',
		];
	}
}
