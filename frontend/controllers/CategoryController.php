<?php

namespace frontend\controllers;

use Yii;
use common\models\Category;
use yii\filters\VerbFilter;
#use frontend\controllers\PropertyController;

class CategoryController extends BaseController{
	
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
		$noindex = YII_ENV_DEV;
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
					'title' => $model->meta_title,
					'description' => '',
					'keywords' => '',
					'noindex' => $noindex,
				],
			]);
		}else{
		
		}
		
	}
	
}
