<?php

namespace common\models\search;

use common\models\Category;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Leads;
use common\models\Users;
use yii\helpers\VarDumper;

/**
 * SearchLeads represents the model behind the search form of `common\models\Leads`.
 */
class SearchLeads extends Leads {
	
	public $categoryName;
	public $userName;
	
	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['id'], 'integer'],
			[['sender', 'phone', 'email', 'message', 'created_at'], 'safe'],
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
		$query = Leads::find();
		
		// add conditions that should always apply here
		
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);
		
		$dataProvider->setSort([
			'attributes' => [
				'id',
				'sender',
				'phone',
				'email',
				'message',
				'created_at',
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
			->andFilterWhere(['like', 'sender', $this->sender])
			->andFilterWhere(['like', 'phone', $this->phone])
			->andFilterWhere(['like', 'email', $this->email])
			->andFilterWhere(['like', 'message', $this->message]);
		
		return $dataProvider;
	}
}
