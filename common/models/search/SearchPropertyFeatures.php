<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PropertyFeatures;

/**
 * SearchPropertyFeaturesTypes represents the model behind the search form of `common\models\PropertyFeatures`.
 */
class SearchPropertyFeatures extends PropertyFeatures{
	
	public $featureType;
	
	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['id', 'feature_type_id'], 'integer'],
			[['name', 'image', 'featureType'], 'safe'],
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
		$query = PropertyFeatures::find();
		
		// add conditions that should always apply here
		
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);
		
		$dataProvider->setSort([
			'attributes' => [
				'id',
				'name',
				'featureType',
				'image',
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
			'id'              => $this->id,
			'feature_type_id' => $this->featureType,
		]);
		
		$query->andFilterWhere(['like', 'name', $this->name])->andFilterWhere(['like', 'image', $this->image]);
		
		return $dataProvider;
	}
}
