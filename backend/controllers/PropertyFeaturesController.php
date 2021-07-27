<?php

namespace backend\controllers;

use common\models\CategoryLink;
use common\models\search\SearchPropertyFeatures;
use Yii;
use common\models\PropertyFeatures;
use common\models\PropertyFeaturesTypes;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PropertyFeaturesController implements the CRUD actions for PropertyFeatures model.
 */
class PropertyFeaturesController extends Controller{
	
	private $pixelden_icons_css = '@webroot/template/pe-icon-7-stroke/css/pe-icon-7-stroke.css';
	
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
	 * Lists all PropertyFeatures models.
	 * @return mixed
	 */
	public function actionIndex(){
		$searchModel = new SearchPropertyFeatures();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
			'feature_types' => $this->getFeatureTypes(),
		]);
	}
	
	/**
	 * Displays a single PropertyFeatures model.
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
	 * Creates a new PropertyFeatures model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate(){
		$model = new PropertyFeatures();
		
		if($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['view', 'id' => $model->id]);
		}else{
			return $this->render('create', [
				'model' => $model,
				'icons' => $this->getPixedenIconsFromCssFile(),
				'feature_types' => $this->getFeatureTypes(),
			]);
		}
	}
	
	/**
	 * Updates an existing PropertyFeatures model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionUpdate($id){
		$model = $this->findModel($id);
		
		if($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['view', 'id' => $model->id]);
		}else{
			return $this->render('update', [
				'model' => $model,
				'icons' => $this->getPixedenIconsFromCssFile(),
				'feature_types' => $this->getFeatureTypes(),
			]);
		}
	}
	
	/**
	 * Deletes an existing PropertyFeatures model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionDelete($id){
		$this->findModel($id)->delete();
		
		return $this->redirect(['index']);
	}
	
	/**
	 * Finds the PropertyFeatures model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return PropertyFeatures the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if(($model = PropertyFeatures::findOne($id)) !== null){
			return $model;
		}else{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	
	private function getPixedenIconsFromCssFile(){
		$ret = [];
		
		$file_name = Yii::getAlias($this->pixelden_icons_css);
		$rows = file($file_name);
		
		foreach($rows as $row){
			if(substr($row, 0, 7) == '.pe-7s-'){
				$a = explode(':', $row);
				$ret[] = str_replace('.', '', $a[0]);
			}
		}
		
		sort($ret);
		reset($ret);
		
		return $ret;
	}
	
	public function getFeatureTypes(){
		$list = PropertyFeaturesTypes::find()->all();
		
		return ArrayHelper::map($list, 'id', 'title');
	}
	
}
