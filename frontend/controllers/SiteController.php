<?php

namespace frontend\controllers;

use common\models\Property;
use common\models\City;
use common\models\Users;
use frontend\models\SearchForm;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\db\Query;
use yii\helpers\VarDumper;
use common\models\State;
use yii\helpers\ArrayHelper;
use frontend\controllers\BaseController;


/**
 * Site controller
 */
class SiteController extends BaseController {
	
	/**
	 * @inheritdoc
	 */
	public function behaviors(){
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'  => ['logout', 'signup'],
				'rules' => [
					[
						'actions' => ['signup'],
						'allow'   => true,
						'roles'   => ['?'],
					],
					[
						'actions' => ['logout'],
						'allow'   => true,
						'roles'   => ['@'],
					],
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'logout' => ['get'],
				],
			],
		];
	}
	
	public function beforeAction($action){
		$actionToRun = $action;
		if(parent::beforeAction($action)){
			if($action->id == 'error'){
				//$this->layout = 'plain';
				
				return true;
			}else{
				return parent::beforeAction($action);
			}
		}else{
			return false;
		}
		
		//
	}
	
	/**
	 * @inheritdoc
	 */
	public function actions(){
		return [
			/*'error'   => [
				'class' => 'yii\web\ErrorAction',
			],*/
			'captcha' => [
				'class'           => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}
	
	/**
	 * Displays homepage.
	 * @return mixed
	 */
	public function actionIndex(){
		$search   = new SearchForm();
		$featured = Property::find()->where(['active' => 1])->all();
		#$featured     = Property::find()->join('LEFT JOIN', 'states', ['properties.state' => 'states.name'])->where(['active' => 1])->all();
		#VarDumper::dump($featured, 10, 1); exit;
		$totalListing = Property::find()->where(['active' => 1])->count();
		$rent         = Property::find()->where(['active' => 1, 'list_for' => 'rent'])->andWhere(['!=', 'image', ''])->limit(4)->all();
		$sell         = Property::find()->where(['active' => 1, 'list_for' => 'sell'])->andWhere(['!=', 'image', ''])->limit(4)->all();
		/// $agents = Users::find()->where(['role'=>'agent'])->limit(9)->all();
		
		$sql = "SELECT u.name, u.image, COUNT(p.user_id) AS total FROM users u LEFT JOIN properties p ON u.id = p.user_id GROUP BY u.id, u.name";
		// $agents = Users::findBySql($sql)->all();
		$connection = \Yii::$app->db;
		$model      = $connection->createCommand($sql);
		$agents     = $model->queryAll();
		
		if($search->load(Yii::$app->request->post())){
			
			
			if($search->type){
				$result = $search->searchHome();
				
				$dataProvider = new ActiveDataProvider([
					'query' => $result,
				]);
				$property     = Property::find()->where(['list_for' => 'rent'])->all();
				
				return $this->render('index', [
					'dataProvider' => $dataProvider,
					'property'     => $property
				]);
			}else{
				return $this->render('not-found', [
					'model' => $search,
				]);
				
			};
			
		}
		
		
		return $this->render('index', [
			'search'       => $search,
			'featured'     => $featured,
			'forRent'      => $rent,
			'forSell'      => $sell,
			'totalListing' => $totalListing,
			'agents'       => $agents,
		]);
	}
	
	public function actionError(){
		$exception = Yii::$app->errorHandler->exception;
		if($exception !== null){
			if($exception->statusCode == 404){
				return $this->render('404', ['exception' => $exception]);
			}else{
				return $this->render('error', ['exception' => $exception]);
			}
		}
	}
	
	/**
	 * Logs in a user.
	 * @return mixed
	 */
	public function action404(){
		return $this->render('404', [
			'error'   => 'Access Dienie',
			'message' => 'Please Login Or Signup Access this page'
		
		]);
	}
	
	public function actionLogin(){
		if(!Yii::$app->user->isGuest){
			return $this->goHome();
		}
		
		$model = new LoginForm();
		if($model->load(Yii::$app->request->post()) && $model->login()){
			return $this->goBack();
		}else{
			return $this->render('login', [
				'model' => $model,
			]);
		}
	}
	
	/**
	 * Logs out the current user.
	 * @return mixed
	 */
	public function actionLogout(){
		Yii::$app->user->logout();
		
		return $this->goHome();
	}
	
	/**
	 * Displays contact page.
	 * @return mixed
	 */
	public function actionContact(){
		$model = new ContactForm();
		
		if($model->load(Yii::$app->request->post())){
			
			if($model->validate()){
				
				if($model->sendEmail(Yii::$app->params['adminEmail'])){
					
					Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
				}else{
					Yii::$app->session->setFlash('error', 'There was an error sending your message.');
				}
			}else{
				$error = $model->getErrors();
				var_dump($error);
				die;
				
			}
			
			
			return $this->refresh();
		}else{
			return $this->render('contact', [
				'model' => $model,
			]);
		}
	}
	
	/**
	 * Displays about page.
	 * @return mixed
	 */
	public function actionAbout(){
		return $this->render('about');
	}
	
	/**
	 * Signs user up.
	 * @return mixed
	 */
	public function actionSignup(){
		$model = new SignupForm();
		if($model->load(Yii::$app->request->post())){
			if($user = $model->signup()){
				if(Yii::$app->getUser()->login($user)){
					return $this->goHome();
				}
			}
		}
		
		return $this->render('signup', [
			'model' => $model,
		]);
	}
	
	/**
	 * Requests password reset.
	 * @return mixed
	 */
	public function actionRequestPasswordReset(){
		$model = new PasswordResetRequestForm();
		if($model->load(Yii::$app->request->post()) && $model->validate()){
			if($model->sendEmail()){
				Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
				
				return $this->goHome();
			}else{
				Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
			}
		}
		
		return $this->render('requestPasswordResetToken', [
			'model' => $model,
		]);
	}
	
	/**
	 * Resets password.
	 *
	 * @param string $token
	 *
	 * @return mixed
	 * @throws BadRequestHttpException
	 */
	public function actionResetPassword($token){
		try{
			$model = new ResetPasswordForm($token);
		}catch(InvalidParamException $e){
			throw new BadRequestHttpException($e->getMessage());
		}
		
		if($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()){
			Yii::$app->session->setFlash('success', 'New password saved.');
			
			return $this->goHome();
		}
		
		return $this->render('resetPassword', [
			'model' => $model,
		]);
	}
	
	
}
