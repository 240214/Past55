<?php

namespace frontend\controllers;

use common\models\search\SearchPosts;
use Yii;
use common\models\Posts;
use common\models\Users;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\controllers\BaseController;
use yii\helpers\VarDumper;

class AuthorController extends BaseController{
	
	private $posts_limit = 6;
	
	public function beforeAction($action){
		return parent::beforeAction($action);
	}
	
	/**
	 * Lists all User models.
	 * @return mixed
	 */
	public function actionIndex(){
		$models = Users::find()->all();
		
		return $this->render('index', ['authors' => $models,]);
	}
	
	public function actionView(){
		$username = Yii::$app->request->get('slug');
		$username = trim($username, '/');
		
		if(!$username){
			throw new NotFoundHttpException('The requested page does not exist.');
		}
		
		$model = Users::findByUsername($username);
		
		if(!$model){
			throw new NotFoundHttpException('The requested page does not exist.');
		}
		
		$postsSearchModel  = new SearchPosts();
		$postsDataProvider = $postsSearchModel->search([]);
		$postsDataProvider->query->where(['posts.user_id' => $model->id, 'posts.type' => 'post']);
		$postsDataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];
		$postsDataProvider->pagination         = ['pageSize' => $this->posts_limit];
		
		#VarDumper::dump($postsDataProvider->getTotalCount(), 10, 1); exit;
		
		
		return $this->render('view', [
			'model' => $model, #User model
			'postsDataProvider' => $postsDataProvider,
		]);
	}
	
}
