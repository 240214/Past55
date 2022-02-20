<?php

namespace backend\controllers;

use common\models\search\SearchProperty;
use Yii;
use common\models\PostsCategories;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use common\models\Property;
use common\models\CategoryLink;
use common\models\search\SearchPostsCategory;

/**
 * PostsCategoryController implements the CRUD actions for Category model.
 */
class PostsCategoryController extends Controller {
	
	public $default_pageSize = 10;
	public $pageSize_list = [7 => 7, 10 => 10, 20 => 20, 30 => 30, 40 => 40, 50 => 50, 100 => 100];
	
	/**
	 * @inheritdoc
	 */
	public function behaviors(){
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'  => ['delete', 'edit', 'update'],
				'rules' => [
					[
						'actions' => ['delete', 'edit', 'update'],
						'allow'   => true,
						'roles'   => ['@'],
					],
				
				
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}
	
	/**
	 * Lists all PostsCategories models.
	 * @return mixed
	 */
	public function actionIndex(){
		
		$pageSize = Yii::$app->request->get('per-page') ? intval(Yii::$app->request->get('per-page')) : $this->default_pageSize;
		
		$searchModel = new SearchPostsCategory();
		
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
		$dataProvider->pagination->pageSize = $pageSize ? $pageSize : $this->default_pageSize;

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
			'pageSize' => $pageSize,
			'pageSize_list' => $this->pageSize_list,
		]);
	}
	
	/**
	 * Displays a single PostsCategories model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException
	 */
	public function actionView($id){
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}
	
	/**
	 * Creates a new PostsCategories model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate(){
		$model = new PostsCategories();
		
		if($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['view', 'id' => $model->id]);
			//return $this->render('create', ['model' => $model]);
		}else{
			return $this->render('create', [
				'model' => $model,
				'templates' => []#$this->getTemplatesTree(),
			]);
		}
	}
	
	/**
	 * Updates an existing PostsCategories model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException
	 */
	public function actionUpdate($id){
		$model = $this->findModel($id);
		
		if($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['view', 'id' => $model->id]);
		}else{
			return $this->render('update', [
				'model' => $model,
				'templates' => []#$this->getTemplatesTree(),
			]);
		}
	}
	
	/**
	 * Deletes an existing PostsCategories model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 */
	public function actionDelete($id){
		$this->findModel($id)->delete();
		
		return $this->redirect(['index']);
	}
	
	/**
	 * Finds the PostsCategories model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return PostsCategories the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if(($model = PostsCategories::findOne($id)) !== null){
			return $model;
		}else{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	
	public function getTemplatesTree($dir = ''){
		$result = [];
		
		$root = Yii::getAlias('@frontend');
		
		if(empty($dir)){
			#$dir = $root.'/views/main/resources';
			$dir = $root.'/views/category';
		}
		
		$cdir = array_diff(scandir($dir), ['..', '.']);
		//VarDumper::dump($cdir, 10, 1);
		
		foreach($cdir as $key => $value){
			if(is_dir($dir.DIRECTORY_SEPARATOR.$value)){
				if(substr($value, 0, 1) != '_'){
					$result[$value] = $this->getTemplatesTree($dir.DIRECTORY_SEPARATOR.$value);
				}
			}else{
				$path = str_replace($root, '', $dir.DIRECTORY_SEPARATOR.$value);
				$result[$path] = $value;
			}
		}
		
		ksort($result);
		reset($result);
		
		#VarDumper::dump($result, 10, 1);
		
		return $result;
	}
	
}
