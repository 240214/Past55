<?php

namespace common\models\search;

use common\models\Property;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Category;
use common\models\SubCategory;
use yii\helpers\VarDumper;

/**
 * SearchSales represents the model behind the search form about `\common\models\Sale`.
 */
class SearchProperty extends Property{
	
	public $categoryName;
	public $nearby_cities = [];
	#public $sub_categoryName;
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['id', 'user_id', 'zipcode', 'active', 'category_id'], 'integer'],
			[['price_negotiable', 'sold', 'likes', 'views', 'availability', 'possession_by', 'category_id', 'sub_category', 'features', 'categoryName'], 'safe'],
			[['title', 'slug', 'size', 'city', 'state', 'country', 'price', 'type', 'bedrooms', 'bathrooms', 'parking', 'garden', 'location', 'address', 'image', 'property_of'], 'string'],
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
		#VarDumper::dump($params, 10, 1);
		
		$query = Property::find();
		$query->joinWith(['category']);
		#$query->joinWith(['sub_category']);
		
		#if(!isset($params['sort'])) $params['SearchProperty']['sort'] = 'id';
		#if(!isset($params['page'])) $params['SearchProperty']['page'] = 1;
		if(isset($params['category_ids'])){
			$category_ids = $params['category_ids'];
		}elseif(isset($params['category_id']) && is_array($params['category_id'])){
			$category_ids = $params['category_id'];
		}
		unset($params['category_ids'], $params['SearchProperty']['category_ids'], $params['category_id'], $params['SearchProperty']['category_id']);
		
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
				'attributes' => [
					'id',
					'image',
					'title',
					'slug',
					'user_id',
					'type',
					'active',
					'city',
					'state',
					'property_of',
					'categoryName' => [
						'asc' => [Category::tableName().'.name' => SORT_ASC],
						'desc' => [Category::tableName().'.name' => SORT_DESC],
					],
				]
			],
		]);

		#VarDumper::dump($params);
		$this->load($params);
		
		if(!$this->validate()){
			VarDumper::dump('not valid');
			// uncomment the following line if you do not want to return any records when validation fails
			#$query->where('0=1');
			return $dataProvider;
		}
		
		if(isset($category_ids) && is_array($category_ids)){
			$query->joinWith(['category_link']);
			$query->andFilterWhere(['IN', 'properties.category_id', $category_ids]);
			$query->orFilterWhere(['IN', 'category_link.category_id', $category_ids]);
			$query->groupBy(['properties.id']);
		}
		
		// grid filtering conditions
		$query->andFilterWhere([
			'properties.id'       => $this->id,
			'properties.user_id'  => $this->user_id,
			'properties.zipcode'   => $this->zipcode,
			'properties.active'   => $this->active,
			#'category_id'   => $this->category_id,
		]);
		
		$cities = [];
		$cities[] = $this->city;
		$cities[] = str_replace('-', ' ', $this->city);
		if(!empty($this->nearby_cities)){
			$cities += $this->nearby_cities;
		}
		$cities = array_filter(array_unique($cities));
		
		
		$query
			->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['like', 'properties.slug', $this->slug])
			->andFilterWhere(['=', 'type', $this->type])
			#->andFilterWhere(['IN', 'city', $cities])
			#->andFilterWhere(['=', 'city', $this->city])
			#->orFilterWhere(['=', 'city', str_replace('-', ' ', $this->city)])
			->andFilterWhere(['=', 'state', $this->state])
			#->andFilterWhere(['=', 'property_of', $this->property_of])
			->andFilterWhere(['=', Category::tableName().'.name', $this->categoryName])
			#->andFilterWhere(['=', SubCategory::tableName().'.name', $this->sub_categoryName])
		;
		
		if(!empty($cities)){
			$query->andFilterWhere(['IN', 'city', $cities]);
		}
		
		#VarDumper::dump($cities, 10, 1); exit;
		#VarDumper::dump($query->createCommand()->getRawSql(), 10, 1); exit;

		/*if(!empty(trim($this->datetime))){
			$datetime = trim($this->datetime);
			if(strstr($datetime, '-') !== false){
				$a = explode('-', $datetime);
				$a = array_map('trim', $a);
				$start_date = strtotime($a[0].' 00:00:00');
				$end_date = strtotime($a[1].' 23:59:59');
			}else{
				$start_date = strtotime($datetime.' 00:00:00');
				$end_date = strtotime($datetime.' 23:59:59');
			}
			$query->andFilterWhere(['between', 'datetime', $start_date, $end_date]);
		}*/

		return $dataProvider;
	}
}
