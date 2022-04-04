<?php

namespace frontend\controllers;

use common\models\Posts;
use common\models\BlogComment;
use common\models\BlogTags;
use common\models\Pages;
use common\models\SiteSettings;
use frontend\models\TaskLabelForm;
use Yii;
use common\models\Property;
use common\models\Users;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\VarDumper;
use frontend\controllers\BaseController;


class PagesController extends BaseController{
	/**
	 * @inheritdoc
	 */
	public function behaviors(){
		return [
			'verbs' => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => ['GET'],
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
		];
	}
	
	
	public function actionView($slug){
		$template = 'view';
		
		$model = Pages::findOne(['slug' => $slug, 'active' => 1]);
		#$siteName = SiteSettings::find()->select('site_name')->one();
		
		if(!empty($model->template)){
			$template = basename($model->template);
		}
		
		return $this->render($template, [
			'model' => $model,
			#'site'  => $siteName
		]);
	}
	
	
}
