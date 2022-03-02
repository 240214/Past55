<?php

namespace backend\controllers;

use common\models\CategoryCityContent;
use common\models\search\SearchCategoryCityContent;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\search\SearchPosts;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\base\ErrorException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * CategoryCityContentController controller
 */
class CategoryCityContentController extends Controller{
	
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
		
		$searchModel  = new SearchCategoryCityContent();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->pagination->pageSize = $pageSize ? $pageSize : $this->default_pageSize;
		
		return $this->render('index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
			'pageSize'      => $pageSize,
			'pageSize_list' => $this->pageSize_list,
			'categories' => $searchModel->getFilterCategories(),
			'states' => $searchModel->getFilterStates(),
			'cities' => $searchModel->getFilterCities(),
		]);
	}
	
	/**
	 * Displays a single CategoryCityContent model.
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
	 * Creates a new CategoryCityContent model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 * @throws \Exception
	 */
	public function actionCreate(){
		$model = new CategoryCityContent();
		
		if($model->load(Yii::$app->request->post())){
			
			try{
				$model->save();
				return $this->redirect(['view', 'id' => $model->id]);
			}catch(\Exception $e){
				#Yii::warning($e->getMessage());
				throw new \Exception($e->getMessage());
			}
		}
		
		return $this->render('create', ['model' => $model]);
	}
	
	/**
	 * Updates an existing CategoryCityContent model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function actionUpdate($id){
		$model = $this->findModel($id);
		
		if($model->load(Yii::$app->request->post())){
			try{
				$model->save();
				return $this->redirect(['view', 'id' => $model->id]);
			}catch(\Exception $e){
				#Yii::warning($e->getMessage());
				throw new \Exception($e->getMessage());
			}
		}
		
		return $this->render('update', ['model' => $model]);
	}
	
	/**
	 * Deletes an existing CategoryCityContent model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
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
			if(!$model->save(false)){
				$ret['error'] = 1;
			}
		}
		
		return $ret;
	}
	
	public function actionValidation(){
		Yii::$app->response->format = Response::FORMAT_JSON;

		if(Yii::$app->request->isAjax){
			$request = Yii::$app->request->post();
			unset($request['CategoryCityContent']['title'], $request['CategoryCityContent']['content'], $request['CategoryCityContent']['preview']);
			
			$model = new CategoryCityContent();
			$model->load($request);
			
			$validate = ActiveForm::validate($model);
			
			
			
			return $validate;
		}
	}
	
	/**
	 * Finds the Pages model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return CategoryCityContent the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if(($model = CategoryCityContent::findOne($id)) !== null){
			return $model;
		}
		
		throw new NotFoundHttpException('The requested page does not exist.');
	}
	
}
