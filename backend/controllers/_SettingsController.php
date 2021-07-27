<?php

namespace backend\controllers;

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
use Yii;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;
use backend\models\SignupForm;

/**
 * Settings controller
 */


define('LOGO_W', 223);
define('LOGO_H', 50);
define('FAV_ICON_SIZE', 10);

define('IMG_DIR_THIS_DELETE', Yii::getAlias('@frontend').'/web/images/members/album/');

class SettingsController extends Controller{
	
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
	
	public function actionSite(){
		// echo IMG_SITE_DIR;die;
		$count = SiteSettings::find()->count();//die;
		
		if($count == "0"){
			$model = new SiteSettings();
			
			if($model->load(Yii::$app->request->post())){
				if(UploadedFile::getInstance($model, 'logo') != null){
					$model->logo = UploadedFile::getInstance($model, 'logo');
					$logo        = $model->uploadLogo();
					$model->logo = $logo;
				}
				$layout = SiteSettings::setLayout($model->layout);
				$model->save(false);
				
				Yii::$app->getSession()->setFlash('success', 'Update successfully');
				# Yii::$app->getSession()->setFlash('info', '<b>Sorry</b> disable in demo');
				
			}
			
			return $this->render('site', ['model' => $model]);
		}else{
			$model = SiteSettings::find()->one();
			$save  = SiteSettings::find()->one();
			if($model->load(Yii::$app->request->post())){
				#$model->image = UploadedFile::getInstance($model, 'image');
				
				if(UploadedFile::getInstance($model, 'logo') != null){
					$model->logo = UploadedFile::getInstance($model, 'logo');
					
					$logo        = $model->uploadLogo();
					$model->logo = $logo;
				}else{
					$model->logo = $save->logo;
				}
				$layout = SiteSettings::setLayout($model->layout);
				
				$model->save(false);
				Yii::$app->getSession()->setFlash('success', 'Update successfully');
				#Yii::$app->getSession()->setFlash('error', '<b>Sorry !!! </b> disable in demo');
				
			}
			
			return $this->render('site', ['model' => $model]);
		}
		
		
	}
	
	//dashboard Action
	
	public function actionDashboard(){
		$user = User::find()->orderBy(['created_at' => SORT_DESC])->limit('5')->all();
		$property  = Property::find()->orderBy(['created_at' => SORT_DESC])->limit('5')->all();;
		
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
			'property'        => $property
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
