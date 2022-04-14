<?php

namespace backend\controllers;

use Yii;
use common\models\Settings;
use common\models\search\SearchSettings;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;
use backend\models\SignupForm;
use yii\helpers\VarDumper;
use common\models\form\SettingsForm;
use yii\base\DynamicModel;


/**
 * SettingsController implements the CRUD actions for Settings model.
 */
class SettingsController extends Controller{
	
	
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
	 * Lists all Settings models.
	 * @return mixed
	 */
	public function actionIndex(){
		$searchModel  = new SearchSettings();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		return $this->render('edit/index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}
	
	/**
	 * Displays a single Settings model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id){
		return $this->render('edit/view', [
			'model' => $this->findModel($id),
		]);
	}
	
	/**
	 * Creates a new Settings model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate(){
		$model = new Settings();
		
		if($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['view', 'id' => $model->id]);
		}
		
		return $this->render('edit/create', [
			'model' => $model,
		]);
	}
	
	/**
	 * Updates an existing Settings model.
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
		
		return $this->render('edit/update', [
			'model' => $model,
		]);
	}
	
	/**
	 * Deletes an existing Settings model.
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
	 * Finds the Settings model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Settings the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if(($model = Settings::findOne($id)) !== null){
			return $model;
		}
		
		throw new NotFoundHttpException('The requested page does not exist.');
	}
	
	public function actionSite(){
		$request = Yii::$app->request;
		
		$settings = Settings::find()->where(['active' => 1])->orderBy(['order' => SORT_ASC])->all();
		#VarDumper::dump($settings, 10, 1); exit;
		
		#Creating Dymanic Model
		$a = $t_r = $e_r = $i_r = [];
		foreach($settings as $setting){
			$a[$setting->setting_name] = !is_null($setting->setting_value) ? $setting->setting_value : '';
			if($setting->field_type == 'email'){
				$e_r = [$setting->setting_name, $setting->field_type];
			}elseif($setting->field_type == 'image'){
				$i_r = [[$setting->setting_name], $setting->field_type, 'skipOnEmpty' => true, 'extensions' => Yii::$app->params['image_exts'], 'maxFiles' => 500];
			}else{
				$t_r[] = $setting->setting_name;
			}
		}
		
		$rules_r = [];
		
		if(!empty($t_r))
			$rules_r[] = [$t_r, 'safe'];

		if(!empty($e_r))
			$rules_r[] = $e_r;
		
		if(!empty($i_r))
			$rules_r[] = $i_r;
		
		$formModel = new SettingsForm();
		$formModel->setDynamicFields($a);
		$formModel->setDynamicRules($rules_r);
		
		#Doing Post request
		if($request->isPost){
			$SettingsForm = $request->post('SettingsForm');

			foreach($SettingsForm as $name => $value){
				#$formModel = new SettingsForm();
				$model = Settings::find()->where(['setting_name' => $name])->one();
				
				if($name == 'logo'){
					if($formModel->logo = UploadedFile::getInstance($formModel, $name)){
						$model->setting_value = $formModel->uploadLogo();
						$model->save(false);
					}
				}else{
					$model->setting_value = $value;
					$model->save(false);
				}
			}
			Yii::$app->getSession()->setFlash('success', 'Update successfully');
			return $this->redirect(Url::toRoute('settings/site'));
		}
		
		#VarDumper::dump($a, 10, 1); exit;
		
		#Filling model with data
		$formModel->setAttributes($a);
		
		
		return $this->render('site', ['model' => $formModel, 'settings' => $settings]);
	}
	
	public function actionAdmin(){
		if(Yii::$app->user->isGuest){
			return $this->goHome();
		}
		$model = new SignupForm();
		if($model->load(Yii::$app->request->post())){
			//$model->
			$user = $model->change();
			if(is_null($user)){
				Yii::$app->getSession()->setFlash('error', '<b>Sorry !!! </b> disable in demo');
			}else{
				Yii::$app->getSession()->setFlash('success', 'Update successfully');
			}
			
		}
		
		return $this->render('admin', ['model' => $model]);
	}
	
	
	
}
