<?php

namespace backend\controllers;

use Yii;
use common\models\SubCategory;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubCategoryController implements the CRUD actions for SubCategory model.
 */
class SubCategoryController extends Controller{
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
	 * Lists all SubCategory models.
	 * @return mixed
	 */
	public function actionIndex(){
		$dataProvider = new ActiveDataProvider([
			'query' => SubCategory::find(),
		]);
		
		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}
	
	/**
	 * Displays a single SubCategory model.
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
	 * Creates a new SubCategory model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate(){
		$model = new SubCategory();
		
		if($model->load(Yii::$app->request->post())){
			if($model->input_options != null){
				$model->input_options = implode(",", array_filter($model->input_options));
			}else{
				$model->input_options = null;
			}
			
			$model->save();
			
			// return $this->redirect(['view', 'id' => $model->id]);
			return $this->render('create', [
				'model' => $model,
			]);
		}else{
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}
	
	/**
	 * Updates an existing SubCategory model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionUpdate($id){
		$model = $this->findModel($id);
		
		if($model->load(Yii::$app->request->post())){
			
			if($model->input_options != null){
				$model->input_options = implode(",", array_filter($model->input_options));
			}else{
				$model->input_options = null;
			}
			
			if($model->save()){
				return $this->redirect(['view', 'id' => $model->id]);
			}
		}else{
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}
	
	/**
	 * Deletes an existing SubCategory model.
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
	 * Finds the SubCategory model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return SubCategory the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if(($model = SubCategory::findOne($id)) !== null){
			return $model;
		}else{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
