<?php

namespace backend\controllers;

use common\models\search\SearchProperty;
use Yii;
use common\models\Category;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use common\models\Property;
use common\models\CategoryLink;
use common\models\search\SearchCategory;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller {
	
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
	 * Lists all Category models.
	 * @return mixed
	 */
	public function actionIndex(){
		
		$pageSize = Yii::$app->request->get('per-page') ? intval(Yii::$app->request->get('per-page')) : $this->default_pageSize;
		
		$searchModel = new SearchCategory();
		
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
	 * Displays a single Category model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionView($id){
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}
	
	/**
	 * Creates a new Category model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate(){
		$model = new Category();
		
		if($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['view', 'id' => $model->id]);
			//return $this->render('create', ['model' => $model]);
		}else{
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}
	
	/**
	 * Updates an existing Category model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionUpdate($id){
		#VarDumper::dump(Yii::$app->user->identity->getId());
		$model = $this->findModel($id);
		
		if($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['view', 'id' => $model->id]);
		}else{
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}
	
	/**
	 * Deletes an existing Category model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionDelete($id){
		$cats_links = CategoryLink::findAll(['category_id' => $id]);
		$properties = Property::findAll(['category_id' => $id]);
		#VarDumper::dump($properties, 10, 1); exit;
		
		if(count($properties) || count($cats_links)){
			$ids = [];
			if(count($properties)){
				foreach($properties as $property){
					$ids[] = $property->id;
				}
			}
			if(count($cats_links)){
				foreach($cats_links as $link){
					$ids[] = $link->property_id;
				}
			}
			if(!empty($ids)){
				$ids = array_unique($ids);
			}
			Yii::$app->getSession()->setFlash('error', 'This category cannot be deleted, since it is used in the following Properties under ID: '.implode(', ', $ids));
		}else{
			$this->findModel($id)->delete();
		}
		
		return $this->redirect(['index']);
	}
	
	/**
	 * Finds the Category model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Category the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if(($model = Category::findOne($id)) !== null){
			return $model;
		}else{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
