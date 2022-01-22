<?php

namespace frontend\controllers;

use Yii;
use common\models\Property;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\Response;
use common\models\FavoriteProperties;
use yii\db\Query;
use PDO;

class CompareController extends PropertyController{
	
	/**
	 * @inheritdoc
	 */
	public function behaviors(){
		return [
			'verbs' => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}
	
	public function actionIndex(){
		$user_favorites = $titles = [];
		$dataProvider = null;
		
		$request = Yii::$app->request;
		#VarDumper::dump($request->get(), 10, 1);
		
		$items = $request->get('items');
		$slugs = $request->get('slug');
		
		if($items){
			$items = explode(':', $items);
			$dataProvider = $this->getProperties($items, false);
		}elseif($slugs){
			$slugs = explode('-vs-', $slugs);
			$dataProvider = $this->getProperties($slugs, true);
		}
		
		$intersect_features = [];
		
		if(!is_null($dataProvider) && $dataProvider->getTotalCount()){
			foreach($dataProvider->getModels() as $model){
				$model->nearby_places = $this->getPropertyNearbyPlaces($model);
				$model->categories = $this->getPropertyCategories($model);
				$model->features_sections = $this->getPropertyFeaturesBySections($model);
				$model->features = $this->getPropertyFeatures($model, false);
				$model->customer_addresses = $this->getCustomerAddresses($model);
				
				$titles[] = $model->title;
				
				/*if(!empty($intersect_features)){
					$intersect_features = array_intersect($intersect_features, $model->features);
				}else{
					$intersect_features = $model->features;
				}*/
			}

			$user_favorites = $this->getUserFavorites();
		}
		
		return $this->render('index', [
			'total_count' => $dataProvider->getTotalCount(),
			'models' => $dataProvider->getModels(),
			'user_favorites' => $user_favorites,
			'intersect_features' => $intersect_features,
			'page_title' => implode(', ', $titles),
		]);
	}
	
	public function actionGetProperty(){
		$titles = [];
		$response = ['error' => 0, 'html' => ''];
		Yii::$app->response->format = Response::FORMAT_JSON;
		
		$request = Yii::$app->request->post();
		$id = $request['property_id'];
		
		$dataProvider = $this->getProperties([$id], false);
		
		if($dataProvider->getTotalCount()){
			foreach($dataProvider->getModels() as $model){
				$model->nearby_places = $this->getPropertyNearbyPlaces($model);
				$model->categories = $this->getPropertyCategories($model);
				$model->features_sections = $this->getPropertyFeaturesBySections($model);
				$model->features = $this->getPropertyFeatures($model, false);
				$model->customer_addresses = $this->getCustomerAddresses($model);
				
				$titles[] = $model->title;
			}
		}
		
		$response['html'] = $this->renderPartial('partials/item', [
			'model' => $dataProvider->getModels()[0],
			'desc_length' => 100,
			'page_title' => implode(', ', $titles),
		]);
		
		return $response;
	}
	
	public function getProperties($items = [], $get_by_slug = false){
		$query = Property::find();
		
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => -1,
			],
			'sort' => [
				'defaultOrder' => [
					'id' => SORT_ASC,
				]
			],
		]);
		
		if(!empty($items)){
			if($get_by_slug){
				$query->andFilterWhere(['IN', 'slug', $items]);
			}else{
				$query->andFilterWhere(['IN', 'id', $items]);
			}
		}
		
		//$dataProvider = $this->addProps($dataProvider);
		
		return $dataProvider;
	}
	
	public function getUserFavorites(){
		#$uid = (Yii::$app->user->identity) ? Yii::$app->user->identity->getId() : 0;
		$sid = Yii::$app->session->id;
		
		$query = new Query();
		$query->select(['properties.id', 'properties.title'])
		      ->from('properties')
		      ->leftJoin('favorite_properties', 'favorite_properties.property_id = properties.id')
		      ->where(['favorite_properties.sid' => $sid]);
		$FavoriteProperties = $query->createCommand()->queryAll(PDO::FETCH_KEY_PAIR);
		
		return $FavoriteProperties;
	}
	
}
