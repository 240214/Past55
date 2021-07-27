<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "customer_addresses".
 * @property int $id
 * @property int $property_id
 * @property string $sid
 * @property string $title
 * @property string $address
 * @property double $lat
 * @property double $lng
 * @property float $distance
 * @property string $distance_type
 * @property string $updated_at
 * @property string $created_at
 */
class CustomerAddresses extends ActiveRecord{
	
	public static $distance_type = 'miles';
	
	/**
	 * {@inheritdoc}
	 */
	public static function tableName(){
		return 'customer_addresses';
	}
	
	
	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['property_id'], 'integer'],
			[['distance'], 'number'],
			[['lat', 'lng'], 'number'],
			[['updated_at', 'created_at'], 'safe'],
			[['sid'], 'string', 'max' => 32],
			[['title', 'address'], 'string', 'max' => 255],
			[['distance_type'], 'string', 'max' => 10],
		];
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(){
		return [
			'id'            => 'ID',
			'property_id'   => 'Property ID',
			'sid'           => 'Sid',
			'title'         => 'Visitor name',
			'address'       => 'Visitor address',
			'lat'           => 'Lat',
			'lng'           => 'Lng',
			'distance'      => 'Distance',
			'distance_type' => 'Distance Type',
			'updated_at'    => 'Updated At',
			'created_at'    => 'Created At',
		];
	}
	
	
}
