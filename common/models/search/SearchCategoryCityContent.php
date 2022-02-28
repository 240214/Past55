<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CategoryCityContent;

/**
 * SearchPosts represents the model behind the search form of `common\models\CategoryCiryContent`.
 */
class SearchCategoryCityContent extends CategoryCityContent {
	
	public $Property;
	
	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['id', 'category_id', 'state_id', 'city_id'], 'integer'],
			[['title', 'image', 'content'], 'safe'],
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
		$query = CategoryCityContent::find();
		
		// add conditions that should always apply here
		
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);
		
		$dataProvider->setSort([
			'attributes' => [
				'category_id',
				'state_id',
				'city_id',
				'title',
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
			'id'     => $this->id,
		]);
		
		$query
			->andFilterWhere(['like', 'title', $this->title]);
		
		return $dataProvider;
	}
}
