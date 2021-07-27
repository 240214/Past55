<?php
namespace backend\controllers;

use common\models\Property;
use common\models\AdmnLoginForm;
use common\models\AmbeInqueryVisitor;
use common\models\Blog;
use common\models\Track;
use Yii;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use yii\data\Pagination;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['user-delete'],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','user', 'property', 'ad-status'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect(Url::toRoute('site/login'));
        }
        $this->layout = "main";
        $user = User::find()->orderBy(['created_at'=>SORT_DESC])->limit('5')->all();
        $property = Property::find()->orderBy(['created_at'=>SORT_DESC])->limit('5')->all();;

        $statistics = Track::find()->limit('5')->all();
        $adsTotal = Property::find()->count();
        $pending = Property::find()->where(['active'=>1])->count();
        $active = ($adsTotal - $pending);
        $totalUser = User::find()->count();
//SELECT id FROM `ad` WHERE  date_sub(from_unixtime(`created_at`), INTERVAL 300 DAY) >= NOW()

      //  SELECT CURDATE() as cur, date_format(from_unixtime(`created_at`), '%Y-%m-%d') as newsd FROM `ad` WHERE  date_format(from_unixtime(`created_at`), '%Y-%m-%d') < CURDATE() + INTERVAL 2000 DAY

//        $blog = Blog::find();
//        $blogTotal = $blog->count();
//        $blogThisMonth = $blog->where();
        return $this->render('index',[
            'total'=>$adsTotal,
            'pending'=>$pending,
            'active'=>$active,
            'statistics'=>$statistics,
            'member'=>$user,
            'property'=>$property,
            'totalUser'=>$totalUser
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = "plain";
        $model = new AdmnLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * user list.
     *
     * @return string
     */
    public function actionUser()
    {



        $count = User::find()->count();
        $pages = new Pagination(['totalCount' => $count,'pageSize'=>10]);
        $model = User::find()->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('user-list',[
            'model'=>$model,
            'pages' => $pages,
            'count'=>$count,

        ]);
    }

    /**
     * user delete.
     *
     * @return string
     */
    public function actionUserDelete($id)
    {
        $model = User::find()->where(['id'=>$id])->one();
        Yii::$app->getSession()->setFlash('warning', '<b>Sorry !!! </b> disable in demo');

        // $model->delete();
        $this->redirect(Url::toRoute('site/user'));

    }
    
    /*public function actionAds()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $count = Property::find()->count();
        $all = Property::find()->all();

        $model = new ad();
        if ($model->load(Yii::$app->request->post()))
        {
            $model->save(false);
            Yii::$app->getSession()->setFlash('success', 'Update successfully');
        }
        return $this->render('property', ['model'=>$model,'count'=>$count,'list'=>$all]);



    }*/
    
    /*public function actionAdStatus($id,$status)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $find = Property::findOne($id);
        $find->status = $status;
        $find->save(false);
        $this->redirect(Url::toRoute('site/property'));

    }*/
	
}
