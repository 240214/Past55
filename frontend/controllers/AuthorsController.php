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

class AuthorsController extends BaseController {
	
	private $posts_limit = 6;
	
	public function beforeAction($action){
		#VarDumper::dump($action, 10, 1); exit;
		return parent::beforeAction($action);
	}
	
	/**
	 * Lists all User models.
	 * @return mixed
	 */
	public function actionIndex(){
		$models = Users::find()->all();

		return $this->render('index', ['authors' => $models]);
	}
	
	public function actionView(){
		$username = Yii::$app->request->get('slug');
		$username = trim($username, '/');
		
		if(!$username){
			throw new NotFoundHttpException('The requested page does not exist.');
		}
		
		$user = Users::findByUsername($username);
		
		if(!$user){
			throw new NotFoundHttpException('The requested page does not exist.');
		}
		
		$url = Yii::$app->request->getUrl();
		if(strstr($url, 'page') !== false){
			$url = explode('page', $url)[0];
			#$url = trim($url, '/');
		}
		
		$postsSearchModel  = new SearchPosts();
		$postsDataProvider = $postsSearchModel->search([]);
		$postsDataProvider->query->where(['posts.user_id' => $user->id, 'posts.type' => 'post']);
		$postsDataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];
		$postsDataProvider->pagination = [
			'pageParam' => 'page',
			'forcePageParam' => false,
			'pageSizeParam' => false,
			'route' => $url.'page-<page:\d+>\/',
			'pageSize' => $this->posts_limit,
			#'page' => $queryParams['page'],
		];
		
		#VarDumper::dump($postsDataProvider->getTotalCount(), 10, 1); exit;
		
		return $this->render('view', [
			'user' => $user, #User model
			'postsSectionTitle' => $this->generatePostsSectionTitle($user->name),
			'postsDataProvider' => $postsDataProvider,
		]);
	}
	
	private function generatePostsSectionTitle($user_name){
		if(empty($user_name)) return '';
		
		$a = explode(' ', $user_name);
		
		return $a[0]."'s Latest Articles";
	}
}
