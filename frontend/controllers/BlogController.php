<?php

namespace frontend\controllers;

use common\models\Posts;
use common\models\BlogComment;
use common\models\BlogTags;
use frontend\models\TaskLabelForm;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Yii;
use common\models\Property;
use common\models\Users;
use yii\base\ErrorException;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\Pagination;
use frontend\controllers\BaseController;

/**
 * TasksController implements the CRUD actions for task model.
 */
define('USER_IMG', Yii::getAlias('@webroot').'/images/user/');

class BlogController extends BaseController {
	
	/**
	 * @inheritdoc
	 */
	public function behaviors(){
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'  => ['delete', 'edit'],
				'rules' => [
					[
						'actions' => ['edit'],
						'allow'   => true,
						'roles'   => ['?'],
					],
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => ['GET'],
				],
			],
		];
	}
	
	public function denyMessages(){
		return ['contact' => 'You are not allowed to perform this action. in demo version'];
	}
	
	public function beforeAction($action){
		$actionToRun = $action;
		try{
			$action->id;
		}catch(ErrorException $e){
			Yii::warning('not allow');
		}
		
		// var_dump($actionToRun->id) ;die;
		
		return parent::beforeAction($action);
	}
	
	/**
	 * Lists all blog models.
	 * @return mixed
	 */
	public function actionIndex($sort = false){
		$count = Posts::find()->count();
		$pages = new Pagination(['totalCount' => $count, 'pageSize' => 1]);
		$model = Posts::find()->offset($pages->offset)->limit($pages->limit)->all();
		$tags  = BlogTags::find()->limit(20)->orderBy(['blog' => SORT_DESC])->all();
		
		return $this->render('index', [
			'model' => $model,
			'pages' => $pages,
			'count' => $count,
			'tags'  => $tags
		]);
		
	}
	
	
	/**
	 * Lists tag search blog models.
	 * @return mixed
	 */
	public function actionTag($tag){
		$count = Posts::find()->count();
		$pages = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
		$model = Posts::find()->where(['like', 'blog_tags', $tag])->offset($pages->offset)->limit($pages->limit)->all();
		$tags  = BlogTags::find()->limit(20)->orderBy(['blog' => SORT_DESC])->all();
		
		return $this->render('index', [
			'model' => $model,
			'pages' => $pages,
			'count' => $count,
			'tags'  => $tags
		]);
		
		
	}
	
	
	////#########################################################/////
	////////////////////////// Action Blog Detail ////////////////////////
	/// #########################################################////
	public function actionDetail($id, $title){
		$id       = base64_decode($id);
		$model    = Posts::findOne($id);
		$reply    = new BlogComment();
		$comments = BlogComment::find()->where(['blog_id' => $id])->all();
		if($reply->load(Yii::$app->request->post())){
			$uid = Yii::$app->user->identity->getId();
			
			if($model->user_id == $uid){
				$reply->author = "author ";
			}
			
			$reply->user_name  = Yii::$app->user->identity->name;
			$reply->user_image = Yii::$app->user->identity->image;
			$reply->user_id    = $uid;
			$reply->created_at = time();
			$reply->blog_id    = $id;
			$reply->save(false);
			$this->refresh();
		}
		
		return $this->render('detail', [
			'blog'     => $model,
			'reply'    => $reply,
			'comments' => $comments
		
		]);
		
	}
	////#########################################################/////
	////////////////////////// Action blog post  ////////////////////////
	/// #########################################################////
	public function actionPost(){
		if(Yii::$app->user->isGuest){
			Yii::$app->session->setFlash('error', 'Please Login Or Signup for Submit a Ad .');
			
			return $this->redirect(Url::toRoute('site/login'));
		}
		$uid   = Yii::$app->user->identity->getId();
		$model = new Posts();
		if($model->load(Yii::$app->request->post())){
			//$model->
			if(UploadedFile::getInstance($model, 'blog_image') != null){
				$model->blog_image = UploadedFile::getInstance($model, 'blog_image');
				$logo              = $model->uploadLogo();
				$model->blog_image = $logo;
			}
			$model->author_name  = Yii::$app->user->identity->name;
			$model->author_image = Yii::$app->user->identity->image;
			$model->user_id      = $uid;
			$model->created_at   = time();
			$model->save(false);
			BlogTags::addTag($model->blog_tags);
			
			Yii::$app->getSession()->setFlash('success', 'post successfully');
			
			return $this->redirect(Url::toRoute('blog/index'));
			
		}
		
		
		return $this->render('post', [
			'model' => $model,
		
		]);
		
	}
	////#########################################################/////
	////////////////////////// Action blog edit  ////////////////////////
	/// #########################################################////
	public function actionEdit($id){
		if(Yii::$app->user->isGuest){
			Yii::$app->session->setFlash('error', 'Please Login Or Signup for Submit a Ad .');
			
			return $this->redirect(Url::toRoute('site/login'));
		}
		$id    = base64_decode($id);
		$uid   = Yii::$app->user->identity->getId();
		$model = Posts::findOne($id);
		$bkp   = Posts::findOne($id);
		
		if($model->load(Yii::$app->request->post())){
			//$model->
			if(UploadedFile::getInstance($model, 'blog_image') != null){
				$model->blog_image = UploadedFile::getInstance($model, 'blog_image');
				$logo              = $model->uploadLogo();
				$model->blog_image = $logo;
			}
			$model->author_name  = Yii::$app->user->identity->name;
			$model->author_image = Yii::$app->user->identity->image;
			$model->user_id      = $uid;
			$model->created_at   = time();
			$model->save(false);
			BlogTags::addTag($model->blog_tags);
			
			Yii::$app->getSession()->setFlash('success', 'post successfully');
			
			return $this->redirect(Url::toRoute('dashboard/blog'));
			
		}else{
			$model->blog_image = $bkp->blog_image;;
		}
		
		
		return $this->render('post', [
			'model' => $model,
		
		]);
		
	}
	
	////#########################################################/////
	////////////////////////// Action blog edit  ////////////////////////
	/// #########################################################////
	public function actionDelete($id){
		$id    = base64_decode($id);
		$uid   = Yii::$app->user->identity->getId();
		$model = Posts::find()->where(['id' => $id])->andWhere(['user_id' => $uid])->one();
		// $model->delete();
		Yii::$app->getSession()->setFlash('success', 'Delete successfully');
		
		return $this->redirect(Url::toRoute('dashboard/blog'));
		
	}
	
	
}
