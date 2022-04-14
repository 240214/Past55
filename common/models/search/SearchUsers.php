<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Users;

/**
 * SearchUsers represents the model behind the search form of `common\models\Users`.
 */
class SearchUsers extends Users{
	
	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['id', 'active'], 'integer'],
			[['name', 'username', 'email', 'mobile', 'city', 'country', 'role'], 'safe'],
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
		$query = Users::find();
		
		// add conditions that should always apply here
		
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);
		
		$dataProvider->setSort([
			'attributes' => [
				'id',
				'active',
				'name',
				'username',
				'email',
				'mobile',
				'city',
				'country',
				'role',
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
			'id' => $this->id,
		]);
		
		$query
			->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'username', $this->username])
			->andFilterWhere(['like', 'email', $this->email])
			->andFilterWhere(['like', 'mobile', $this->mobile])
			->andFilterWhere(['like', 'city', $this->city])
			->andFilterWhere(['=', 'role', $this->role])
			->andFilterWhere(['like', 'country', $this->country]);
		
		return $dataProvider;
	}
}
