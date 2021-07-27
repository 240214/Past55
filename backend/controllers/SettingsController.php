<?php

namespace backend\controllers;

use Yii;
use common\models\Settings;
use common\models\search\SearchSettings;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Property;
use common\models\Admin;
use common\models\Album;
use common\models\Boost;
use common\models\City;
use common\models\Contact;
use common\models\Credit;
use common\models\Faq;
use common\models\GoogleAds;
use common\models\SiteSettings;
use common\models\MainMenu;
use common\models\Product;
use common\models\Track;
use common\models\User;
use common\models\VipPlan;
#use frontend\models\SignupForm;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\UploadedFile;
use backend\models\SignupForm;
use yii\helpers\VarDumper;
use common\models\form\SettingsForm;
use yii\base\DynamicModel;

define('LOGO_W', 223);
define('LOGO_H', 50);
define('FAV_ICON_SIZE', 10);

define('IMG_DIR_THIS_DELETE', Yii::getAlias('@frontend').'/web/images/members/album/');

/**
 * SettingsController implements the CRUD actions for Settings model.
 */
class SettingsController extends Controller{
	
	public $image_exts = 'gif, png, jpg, jpeg';
	
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
	
	#----------------CUSTOM METHODS-----------------------
	
	public function actionSite(){
		$request = Yii::$app->request;
		
		$settings = Settings::find()->where(['active' => 1])->orderBy(['order' => SORT_ASC])->all();
		
		#Creating Dymanic Model
		$a = $t_r = $e_r = $i_r = [];
		foreach($settings as $setting){
			$a[$setting->setting_name] = $setting->setting_value;
			if($setting->field_type == 'email'){
				$e_r = [$setting->setting_name, $setting->field_type];
			}elseif($setting->field_type == 'image'){
				$i_r = [[$setting->setting_name], $setting->field_type, 'skipOnEmpty' => true, 'extensions' => $this->image_exts, 'maxFiles' => 500];
			}else{
				$t_r[] = $setting->setting_name;
			}
		}
		$formModel = new SettingsForm();
		$formModel->setDynamicFields($a);
		$formModel->setDynamicRules([[$t_r, 'safe'], $e_r, $i_r]);
		
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
		
		#Filling model with data
		$formModel->setAttributes($a);
		
		
		return $this->render('site', ['model' => $formModel, 'settings' => $settings]);
	}
	
	public function actionDashboard(){
		$user     = User::find()->orderBy(['created_at' => SORT_DESC])->limit('5')->all();
		$property = Property::find()->orderBy(['created_at' => SORT_DESC])->limit('5')->all();;
		
		$statistics = Track::find()->limit('5')->all();
		$adsTotal   = Property::find()->count();
		$pending    = Property::find()->where(['status' => 'active'])->count();
		$active     = ($adsTotal - $pending);
		
		return $this->render('index', [
			'total'      => $adsTotal,
			'pending'    => $pending,
			'active'     => $active,
			'statistics' => $statistics,
			'member'     => $user,
			'property'   => $property
		]);
		
		//return $this->render('faq', ['model'=>$model,'list'=>$list]);
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
	
	public function actionPlan($action = false, $id = false){
		if(Yii::$app->user->isGuest){
			return $this->goHome();
		};
		$model = new VipPlan();
		
		if($action){
			switch($action){
				case "delete":
					$delete = VipPlan::findOne($id);
					if($delete){
						$delete->delete();
						
						return $this->redirect(Url::toRoute('settings/plan'));
					}else{
						Yii::$app->getSession()->setFlash('warning', 'Deleted already. please refresh the page ');
						
						return $this->redirect(Url::toRoute('settings/plan'));
					}
					break;
				case "edit":
					$edit = VipPlan::findOne($id);
					
					if($edit->load(Yii::$app->request->post())){
						//$model->
						$edit->save(false);
						Yii::$app->getSession()->setFlash('success', 'edit successfully');
					}
					$list = VipPlan::find()->all();
					
					return $this->render('plan', ['model' => $edit, 'list' => $list]);
					break;
				case "3":
					$msg = "4";
					break;
			}
		}else{
			
			if($model->load(Yii::$app->request->post())){
				//$model->
				$model->save(false);
				Yii::$app->getSession()->setFlash('success', 'Update successfully');
			}
		}
		$list = VipPlan::find()->all();
		
		return $this->render('plan', ['model' => $model, 'list' => $list]);
	}
	
	public function actionImage(){
		if(Yii::$app->user->isGuest){
			return $this->goHome();
		}
		$count = Album::find()->count();
		$pages = new Pagination(['totalCount' => $count, 'pageSize' => 10]);
		$model = Album::find()->offset($pages->offset)->limit($pages->limit)->all();
		
		
		return $this->render('image', [
			'model' => $model,
			'pages' => $pages,
			'count' => $count,
		]);
		
	}
	
	public function actionImageDelete($id){
		if(Yii::$app->user->isGuest){
			return $this->goHome();
		};
		
		$model = Album::find()->where(['id' => $id])->one();
		
		$img = $model->image;
		
		if(file_exists(IMG_DIR_THIS_DELETE.$img)){
			unlink(IMG_DIR_THIS_DELETE.$img);
		}
		$model->delete();
		$this->redirect(Url::toRoute('settings/image'));
		
		
	}
	
	public function actionAds(){
		if(Yii::$app->user->isGuest){
			return $this->goHome();
		}
		$count = GoogleAds::find()->count();
		$all   = GoogleAds::find()->all();
		
		$model = new GoogleAds();
		if($model->load(Yii::$app->request->post())){
			$model->save(false);
			Yii::$app->getSession()->setFlash('success', 'Update successfully');
		}
		
		return $this->render('property', ['model' => $model, 'count' => $count, 'list' => $all]);
		
		
	}
	
}
