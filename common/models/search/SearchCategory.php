<?php

namespace common\models\search;

use common\models\Category;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SubCategory;
use yii\helpers\VarDumper;

/**
 * SearchSales represents the model behind the search form about `\common\models\Sale`.
 */
class SearchCategory extends Category{
	
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['id'], 'integer'],
			[['name', 'icon', 'type', 'slug', 'h1_title', 'meta_title', 'template'], 'string'],
		];
	}


	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params){

		$query = Category::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		/*$dataProvider->setSort([
			'attributes' => [
				'id',
				'name',
				'type',
				'icon',
			]
		]);*/

		$this->load($params);
		
		if(!$this->validate()){
			// uncomment the following line if you do not want to return any records when validation fails
			#$query->where('0=1');
			return $dataProvider;
		}

		// grid filtering conditions
		$query->andFilterWhere([
			'id' => $this->id,
		]);
		
		$query
			->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'slug', $this->slug])
			->andFilterWhere(['like', 'type', $this->type])
			->andFilterWhere(['like', 'h1_title', $this->h1_title])
			->andFilterWhere(['like', 'template', $this->template])
			->andFilterWhere(['like', 'meta_title', $this->meta_title]);


		return $dataProvider;
	}
}
