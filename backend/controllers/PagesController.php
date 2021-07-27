<?php

namespace backend\controllers;

use common\models\Pages;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\search\SearchPages;
use yii\web\NotFoundHttpException;

/**
 * PagesController controller
 */
class PagesController extends Controller{
	
	public $default_pageSize = 20;
	public $pageSize_list = [7 => 7, 10 => 10, 20 => 20, 30 => 30, 40 => 40, 50 => 50, 100 => 100];
	
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
	 * @inheritdoc
	 */
	public function actions(){
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}
	
	public function actionIndex(){
		$pageSize = Yii::$app->request->get('per-page') ? intval(Yii::$app->request->get('per-page')) : $this->default_pageSize;
		
		$searchModel  = new SearchPages();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->pagination->pageSize = $pageSize ? $pageSize : $this->default_pageSize;
		
		return $this->render('index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
			'pageSize'      => $pageSize,
			'pageSize_list' => $this->pageSize_list,
		]);
	}
	
	/**
	 * Displays a single Property model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id){
		
		$model = $this->findModel($id);
		
		return $this->render('view', [
			'model' => $model,
			#'property_types' => $model->getPropertyTypes(),
			#'property_of_types' => $model->getPropertyOfTypes(),
			#'categories' => $model->getCategories(),
		]);
	}
	
	/**
	 * Creates a new Pages model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate(){
		$model = new Pages();
		
		if($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['view', 'id' => $model->id]);
		}
		
		return $this->render('create', [
			'model' => $model,
		]);
	}
	
	/**
	 * Updates an existing Pages model.
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
	 * Deletes an existing Pages model.
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
	 * Finds the Pages model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Pages the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if(($model = Pages::findOne($id)) !== null){
			return $model;
		}
		
		throw new NotFoundHttpException('The requested page does not exist.');
	}
	
}
