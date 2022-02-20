<?php

namespace common\models\search;

use common\models\PostsCategories;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SubCategory;
use yii\helpers\VarDumper;

/**
 * SearchPostsCategory represents the model behind the search form about `\common\models\Sale`.
 */
class SearchPostsCategory extends PostsCategories {
	
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['id'], 'integer'],
			[['title', 'slug'], 'string'],
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

		$query = PostsCategories::find();

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
			->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['like', 'slug', $this->slug]);


		return $dataProvider;
	}
}
