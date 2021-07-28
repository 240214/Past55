<?php

namespace backend\controllers;

use common\models\Property;
use Yii;
use common\models\City;
use common\models\search\SearchCity;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * CityController implements the CRUD actions for City model.
 */
class CityController extends Controller{
	
	public $default_pageSize = 10;
	public $pageSize_list = [7 => 7, 10 => 10, 15 => 15, 20 => 20, 30 => 30, 40 => 40, 50 => 50, 100 => 100];
	
	/**
	 * {@inheritdoc}
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
	
	/**
	 * Lists all City models.
	 * @return mixed
	 */
	public function actionIndex(){
		$pageSize = Yii::$app->request->get('per-page') ? intval(Yii::$app->request->get('per-page')) : $this->default_pageSize;
		
		$searchModel = new SearchCity();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->pagination->pageSize = $pageSize ? $pageSize : $this->default_pageSize;
		
		return $this->render('index', [
			'searchModel'   => $searchModel,
			'dataProvider'  => $dataProvider,
			'pageSize'      => $pageSize,
			'pageSize_list' => $this->pageSize_list,
			'states' => $searchModel->getStates(),
		]);
	}
	
	/**
	 * Displays a single City model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id){
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}
	
	/**
	 * Creates a new City model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate(){
		$model = new City();
		
		if($model->load(Yii::$app->request->post())){
			if(!empty($model->nearby_cities))
				$model->nearby_cities = implode(',', $model->nearby_cities);
			
			$model->save();
			
			return $this->redirect(['view', 'id' => $model->id]);
		}
		
		$nearby_cities_list = $this->getNearbyCitiesByPropertiesCities($model);
		
		if($model->nearby_cities){
			$model->nearby_cities = explode(',', $model->nearby_cities);
		}
		
		return $this->render('create', [
			'model' => $model,
			'nearby_cities_list' => $nearby_cities_list,
		]);
	}
	
	/**
	 * Updates an existing City model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id){
		$model = $this->findModel($id);
		
		
		if($model->load(Yii::$app->request->post())){
			
			if(!empty($model->nearby_cities))
				$model->nearby_cities = implode(',', $model->nearby_cities);
			
			$model->save();
			
			return $this->redirect(['view', 'id' => $model->id]);
		}
		
		$nearby_cities_list = $this->getNearbyCitiesByPropertiesCities($model);
		
		if($model->nearby_cities){
			$model->nearby_cities = explode(',', $model->nearby_cities);
		}
		
		return $this->render('update', [
			'model' => $model,
			'nearby_cities_list' => $nearby_cities_list,
		]);
	}
	
	/**
	 * Deletes an existing City model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($id){
		$this->findModel($id)->delete();
		
		return $this->redirect(['index']);
	}
	
	/**
	 * Finds the City model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return City the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if(($model = City::findOne($id)) !== null){
			return $model;
		}
		
		throw new NotFoundHttpException('The requested page does not exist.');
	}
	
	private function getNearbyCitiesByPropertiesCities($model){
		/*$_sql = "SELECT c.id, c.name, p.city
				 FROM properties p
				 LEFT JOIN states s ON p.state = s.name
				 LEFT JOIN cities c ON c.state_id = s.id AND p.city = c.name
				 WHERE s.id = :state_id AND p.active = 1 AND p.city != :name AND p.city != ''
				 GROUP BY p.city";*/
		
		$_sql = "SELECT c.id, c.name
				 FROM cities c
				 LEFT JOIN states s ON c.state_id = s.id
				 LEFT JOIN properties p ON p.state = s.name AND p.city = c.name
				 WHERE s.id = :state_id AND p.active = 1 AND p.city != :name AND p.city != ''
				 GROUP BY p.city";
		
		$cities = Property::findBySql($_sql, [':state_id' => $model->state_id, ':name' => $model->name])->asArray()->all();
		
		#VarDumper::dump($cities, 10, 1);
		
		return ArrayHelper::map($cities, 'id', 'name');
	}
	
}
