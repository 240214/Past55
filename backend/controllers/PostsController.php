<?php

namespace backend\controllers;

use common\models\Posts;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\search\SearchPosts;
use yii\web\NotFoundHttpException;
use yii\helpers\FileHelper;
use yii\helpers\VarDumper;

/**
 * PostsController controller
 */
class PostsController extends Controller{
	
	private $user_id = 0;
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
		$this->user_id = Yii::$app->user->identity->getId();

		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}
	
	public function actionIndex(){
		$pageSize = Yii::$app->request->get('per-page') ? intval(Yii::$app->request->get('per-page')) : $this->default_pageSize;
		
		$searchModel  = new SearchPosts();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->pagination->pageSize = $pageSize ? $pageSize : $this->default_pageSize;
		
		return $this->render('index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
			'pageSize'      => $pageSize,
			'pageSize_list' => $this->pageSize_list,
			'categories' => $searchModel->getFilterCategories(),
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
		$request = Yii::$app->request->post();
		$request['Posts']['user_id'] = $this->user_id;
		$request['Posts']['created_at'] = time();

		$model = new Posts();
		
		if($model->load($request) && $model->save()){
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
		$request = Yii::$app->request->post();
		
		$model = $this->findModel($id);
		
		if($model->created_at == 0 || is_null($model->created_at)){
			$request['Posts']['created_at'] = time();
		}
		
		if($model->load($request) && $model->save()){
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
	
	public function actionRemoveImage($id){
		$ret = ['error' => 0];
		
		Yii::$app->response->format = 'json';
		$request_data = Yii::$app->request->post('data');
		
		if(Yii::$app->request->isAjax){
			$model = $this->findModel($id);
			
			switch($request_data['field']){
				case "image":
					if(!$this->removeMainImage($model, $request_data))
						$ret['error'] = 1;
					break;
			}
			
			return $ret;
		}
	}
	
	private function removeMainImage($model, $data){
		$model->image = '';
		
		if($ret = $model->save(false)){
			$this->removeImageFile($data);
		}
		
		return $ret;
	}
	
	private function removeImageFile($data){
		$dir = Yii::getAlias('@posts_images').'/';
		
		
		$files = [
			$dir.$data['id'].'/'.$data['file'],
			$dir.$data['id'].'/thumbs/'.$data['file']
		];
		
		$thumbs_directory = array_diff(scandir($dir.$data['id'].'/thumbs/'), ['..', '.']);
		if(!empty($thumbs_directory)){
			foreach($thumbs_directory as $file){
				if(strstr($file, pathinfo($data['file'])['filename']) !== false){
					$files[] = $dir.$data['id'].'/thumbs/'.$file;
				}
			}
		}
		
		foreach($files as $file)
			if(file_exists($file))
				FileHelper::unlink($file);
	}
	
	/**
	 * Finds the Pages model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Posts the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if(($model = Posts::findOne($id)) !== null){
			return $model;
		}
		
		throw new NotFoundHttpException('The requested page does not exist.');
	}
	
}
