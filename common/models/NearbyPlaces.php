<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\Property;

/**
 * This is the model class for table "nearby_places".
 *
 * @property int $id
 * @property int $property_id
 * @property string $place_id
 * @property string $icon_url
 * @property string $name
 * @property string $address
 * @property string $type
 * @property double $rating
 * @property double $lat
 * @property double $lng
 * @property float $distance
 * @property string $distance_type
 * @property int $active
 */
class NearbyPlaces extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nearby_places';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['property_id', 'active'], 'integer'],
            [['rating', 'lat', 'lng', 'distance'], 'number'],
            [['place_id'], 'string', 'max' => 100],
            [['icon_url'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 100],
            [['type'], 'string', 'max' => 40],
            [['distance_type'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'property_id' => 'Property',
            'place_id' => 'Place ID',
            'icon_url' => 'Icon',
            'name' => 'Name',
            'address' => 'Address',
            'type' => 'Type',
            'rating' => 'Rating',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'distance' => 'Distance',
            'distance_type' => 'Distance Type',
            'active' => 'Active',
            'Property' => 'Property',
        ];
    }
	
	public function getProperty(){
		$prop_model = Property::find()->where(['id' => $this->property_id])->one();
		
		return $prop_model->title;
	}
	
}
