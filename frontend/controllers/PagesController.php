<?php

namespace frontend\controllers;

use common\models\Blog;
use common\models\BlogComment;
use common\models\BlogTags;
use common\models\Pages;
use common\models\SiteSettings;
use frontend\models\TaskLabelForm;
use Yii;
use common\models\Property;
use common\models\User;
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
		$model = Pages::findOne(['slug' => $slug]);
		$siteName = SiteSettings::find()->select('site_name')->one();
		
		return $this->render('view', [
			'model' => $model,
			'site'  => $siteName
		]);
	}
	
	
}
