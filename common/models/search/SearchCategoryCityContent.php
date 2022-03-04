<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CategoryCityContent;
use common\models\Category;
use common\models\State;
use common\models\City;
use yii\helpers\VarDumper;

/**
 * SearchPosts represents the model behind the search form of `common\models\CategoryCiryContent`.
 */
class SearchCategoryCityContent extends CategoryCityContent {
	
	public $Property;
	public $categoryName;
	public $stateName;
	public $cityName;
	
	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['id', 'category_id', 'state_id', 'city_id', 'active'], 'integer'],
			[['title', 'image', 'content', 'categoryName', 'stateName', 'cityName'], 'safe'],
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
		$query->joinWith(['category']);
		$query->joinWith(['state']);
		$query->joinWith(['city']);
		
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);
		
		$dataProvider->setSort([
			'attributes' => [
				'category_id',
				'state_id',
				'city_id',
				'title',
				'active',
				'categoryName' => [
					'asc' => [Category::tableName().'.name' => SORT_ASC],
					'desc' => [Category::tableName().'.name' => SORT_DESC],
				],
				'stateName' => [
					'asc' => [State::tableName().'.name' => SORT_ASC],
					'desc' => [State::tableName().'.name' => SORT_DESC],
				],
				'cityName' => [
					'asc' => [City::tableName().'.name' => SORT_ASC],
					'desc' => [City::tableName().'.name' => SORT_DESC],
				],
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
			'active'   => $this->active,
		]);
		
		$query
			->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['=', Category::tableName().'.name', $this->categoryName])
			->andFilterWhere(['=', State::tableName().'.name', $this->stateName])
			->andFilterWhere(['=', City::tableName().'.name', $this->cityName]);
		
		return $dataProvider;
	}
}
