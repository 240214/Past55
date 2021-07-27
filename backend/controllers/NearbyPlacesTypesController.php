<?php

namespace backend\controllers;

use Yii;
use common\models\NearbyPlacesTypes;
use common\models\search\SearchNearbyPlacesTypes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NearbyPlacesTypesController implements the CRUD actions for NearbyPlacesTypes model.
 */
class NearbyPlacesTypesController extends Controller{
	
	public $default_pageSize = 20;
	public $pageSize_list = [7 => 7, 10 => 10, 20 => 20, 30 => 30, 40 => 40, 50 => 50, 100 => 100];
	
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
	 * Lists all NearbyPlacesTypes models.
	 * @return mixed
	 */
	public function actionIndex(){
		$pageSize = Yii::$app->request->get('per-page') ? intval(Yii::$app->request->get('per-page')) : $this->default_pageSize;
		
		$searchModel                        = new SearchNearbyPlacesTypes();
		$dataProvider                       = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->pagination->pageSize = $pageSize ? $pageSize : $this->default_pageSize;
		
		return $this->render('index', [
			'searchModel'   => $searchModel,
			'dataProvider'  => $dataProvider,
			'pageSize'      => $pageSize,
			'pageSize_list' => $this->pageSize_list,
		]);
	}
	
	/**
	 * Displays a single NearbyPlacesTypes model.
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
	 * Creates a new NearbyPlacesTypes model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate(){
		$model = new NearbyPlacesTypes();
		
		if($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['view', 'id' => $model->id]);
		}
		
		return $this->render('create', [
			'model' => $model,
		]);
	}
	
	/**
	 * Updates an existing NearbyPlacesTypes model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id){
		$model = $this->findModel($id);
		
		if($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['view', 'id' => $model->id]);
		}
		
		return $this->render('update', [
			'model' => $model,
		]);
	}
	
	/**
	 * Deletes an existing NearbyPlacesTypes model.
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
	
	public function actionSetStatus($id){
		$ret = ['error' => 0, 'status' => ''];
		
		Yii::$app->response->format = 'json';
		
		if(Yii::$app->request->isAjax){
			$model = $this->findModel($id);
			$model->active = Yii::$app->request->post('active') == 'true' ? 1 : 0;
			if(!$model->save(false)){
				$ret['error'] = 1;
			}
		}
		
		return $ret;
	}
	
	/**
	 * Finds the NearbyPlacesTypes model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return NearbyPlacesTypes the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if(($model = NearbyPlacesTypes::findOne($id)) !== null){
			return $model;
		}
		
		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
