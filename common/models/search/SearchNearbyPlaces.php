<?php

namespace common\models\search;

use common\models\Category;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\NearbyPlaces;
use common\models\Property;

/**
 * SearchNearbyPlaces represents the model behind the search form of `common\models\NearbyPlaces`.
 */
class SearchNearbyPlaces extends NearbyPlaces{
	
	public $Property;
	
	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['id', 'property_id', 'distance', 'active'], 'integer'],
			[['place_id', 'icon_url', 'name', 'address', 'type', 'distance_type', 'roperty_id', 'Property'], 'safe'],
			[['rating', 'lat', 'lng'], 'number'],
		];
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function scenarios(){
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}
	
	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params){
		$query = NearbyPlaces::find();
		
		// add conditions that should always apply here
		
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);
		
		$dataProvider->setSort([
			'attributes' => [
				'id',
				'Property',
				'icon_url',
				'name',
				'type',
				'address',
				'distance',
				'distance_type',
				'active',
			]
		]);
		
		$this->load($params);
		
		if(!$this->validate()){
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}
		
		// grid filtering conditions
		$query->andFilterWhere([
			'id'          => $this->id,
			'property_id' => $this->Property,
			'rating'      => $this->rating,
			'lat'         => $this->lat,
			'lng'         => $this->lng,
			'distance'    => $this->distance,
			'active'      => $this->active,
		]);
		
		$query->andFilterWhere(['like', 'place_id', $this->place_id])
		      ->andFilterWhere(['like', 'icon_url', $this->icon_url])
		      ->andFilterWhere(['like', 'name', $this->name])
		      ->andFilterWhere(['like', 'address', $this->address])
		      ->andFilterWhere(['like', 'type', $this->type])
		      ->andFilterWhere(['like', 'distance_type', $this->distance_type]);
		
		return $dataProvider;
	}
}
