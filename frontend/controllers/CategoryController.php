<?php

namespace frontend\controllers;

use Yii;
use common\models\Category;
use yii\base\ErrorException;
use yii\filters\VerbFilter;
#use frontend\controllers\PropertyController;

class CategoryController extends BaseController{
	
	private $noindex = false;
	public $default_pageSize = 14;
	public $customer_all_addresses = [];
	
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
	
	public function beforeAction($action){
		$this->noindex = YII_ENV_DEV;
		
		return parent::beforeAction($action);
	}
	
	/**
	 * @inheritdoc
	 */
	public function actions(){
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			/*'captcha' => [
				'class'           => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],*/
		];
	}
	
	/**
	 * Lists all Category models.
	 * @return mixed
	 * @throws \yii\base\InvalidConfigException
	 */
	public function actionIndex(){
		$queryParams = Yii::$app->request->getQueryParams();
		$cat_slug    = $queryParams['category'];
		
		$model = Category::find()->where(['slug' => $cat_slug])->one();
		
		if(!is_null($model->template)){
			$path = $model->template;
			$path = str_replace(['/views', '/category'], '', $path);
			$path = trim($path, '/');
			
			#VarDumper::dump($path, 10, 1); exit;
			return $this->render($path, [
				'category_id' => $model->id,
				'category_slug' => $model->slug,
				'meta' => [
					'h1' => $model->title,
					'title' => $model->meta_title,
					'description' => '',
					'keywords' => '',
					'noindex' => $this->noindex,
				],
			]);
		}else{
		
		}
		
	}
	
}
