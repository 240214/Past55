<?php

namespace frontend\controllers;

use common\models\MySearch;
use common\models\SavedAgents;
use common\models\SavedProperty;
use frontend\models\ContactForm;
use Yii;
use common\models\Property;
use common\models\Users;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\UserRating;
use common\models\UserReview;
use frontend\controllers\BaseController;

/**
 * PropertyController implements the CRUD actions for User model.
 */
define('USER_IMG', Yii::getAlias('@webroot') .'/images/user/');

class MyController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['delete', 'edit'],
                'rules' => [
                    [
                        'actions' => ['edit'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],


                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $agents = Users::find()->all();
        return $this->render('index',['agent'=>$agents]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
//    agent detail profile displayed  below########
    public function actionProfile($id=false,$username=false)
    {
        if(!$username and !$id)
        {
            $model = Users::findOne(Yii::$app->user->identity->getId());

        }
        elseif($id)
        {
            $model = Users::findByUsername($id);
        }
        else
        {
            $model = Users::findByUsername($username);

        };

        $fvrt = SavedAgents::find()->where(['agent_id'=>$model->id])->count();

        $property = Property::find()->where(['user_id'=>$model['id']])->all();
        $listing = Property::find()->where(['user_id'=>$model['id']])->count();
        $sold = Property::find()->where(['user_id'=>$model['id']])->andWhere(['sold'=>'yes'])->count();
        $rating = UserRating::find()->where(['agent_id'=>$model->id])->one();
        $total_reviews = UserReview::find()->where(['agent_id'=>$model->id])->count();
        $contact = new ContactForm();
        if ($contact->load(Yii::$app->request->post()) && $contact->validate())
        {
            $email = $model['email'];
            if ($contact->inquiry($email)) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }
            return $this->refresh();
        }

        $view = ($model->role == "agent")?"agent_private_detail":"guest_private_detail";

        return $this->render($view, [
            'agent' => $model,
            'property'=>$property,
            'listing'=>$listing,
            'sold'=>$sold,
            'rating'=>$rating,
            'total_review'=>$total_reviews,
            'fvrt'=>$fvrt
        ]);
    }

    //    agent detail property displayed below ########
    public function actionProperty()
    {
       $uid = Yii::$app->user->identity->getId();
       $model = Users::find()->where(['id'=>$uid])->one();
       //$saveProperty = SavedProperty::find()->where(['user_id'=>$uid])->all();
        //for join saved property table and ad table
        //here is SQl query for manual mode
        ////SELECT ad.id,ad.title,saved_property.user_id FROM ad INNER JOIN saved_property on ad.id = saved_property.property_id WHERE saved_property.user_id = 4

       $query = new Query();
       $query->select(['ad.id','ad.title','ad.price','ad.bathrooms','ad.bedrooms','ad.image'])->from('ad')->join('inner join','saved_property','saved_property.property_id = ad.id')->where(['saved_property.user_id'=>$uid]);
       $command = $query->createCommand();
        $saveProperty = $command->queryAll();

        $rating = UserRating::find()->where(['agent_id'=>$model->id])->one();
        $total_reviews = UserReview::find()->where(['agent_id'=>$model->id])->count();
        return $this->render('saved_property', [
            'agent' => $model,
            'saved'=>$saveProperty,
            'rating'=>$rating,
            'total_review'=>$total_reviews
        ]);
    }
    //    agent detail property displayed below ########
    public function actionSearch()
    {
        $uid = Yii::$app->user->identity->getId();
        $model = Users::find()->where(['id'=>$uid])->one();
        $count = MySearch::find()->where(['user_id'=>$uid])->count();
        $pages = new Pagination(['totalCount' => $count,'pageSize'=>10]);
        $search = MySearch::find()->where(['user_id'=>$uid])->offset($pages->offset)->limit($pages->limit)->all();


        $rating = UserRating::find()->where(['agent_id'=>$model->id])->one();
        $total_reviews = UserReview::find()->where(['agent_id'=>$model->id])->count();
        return $this->render('my_search', [
            'agent' => $model,
            'rating'=>$rating,
            'total_review'=>$total_reviews,
            'saved'=>$search,
            'pages' => $pages,
            'count'=>$count,
        ]);
    }


    public function actionAgents($user=false)
    {
        $uid = Yii::$app->user->identity->getId();
        $model = Users::find()->where(['id'=>$uid])->one();

        $query = new Query();
        $query->select(['saved_agents.agent_id as agent_id','user.id','user.username','user.mobile','user.email','user.image'])->from('user')->join('inner join','saved_agents','saved_agents.agent_id = user.id')->where(['saved_agents.user_id'=>$uid]);
        $command = $query->createCommand();
        $saveAgents = $command->queryAll();

        $rating = UserRating::find()->where(['agent_id'=>$model->id])->one();
        $total_reviews = UserReview::find()->where(['agent_id'=>$model->id])->count();
        return $this->render('saved_agents', [
            'agent' => $model,
            'saved'=>$saveAgents,
            'rating'=>$rating,
            'total_review'=>$total_reviews
        ]);
    }

    public function actionListing()
    {
        $uid = Yii::$app->user->identity->getId();
        $model = Users::find()->where(['id'=>$uid])->one();

        $listing = Property::find()->where(['user_id'=>$uid])->all();

        $rating = UserRating::find()->where(['agent_id'=>$model->id])->one();
        $total_reviews = UserReview::find()->where(['agent_id'=>$model->id])->count();
        return $this->render('my_listing', [
            'agent' => $model,
            'listing'=>$listing,
            'rating'=>$rating,
            'total_review'=>$total_reviews
        ]);
    }
    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Property();

        if ($model->load(Yii::$app->request->post()))
        {
            if (UploadedFile::getInstances($model, 'image')) {
                $model->image = UploadedFile::getInstances($model, 'image');
                $screen = $model->ScreenShot();
                $model->image = $screen;
            } else {
                $model->image = false;
            }
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = Users::findOne(Yii::$app->user->identity->getId());

        if ($model->load(Yii::$app->request->post())) {

            if (UploadedFile::getInstances($model, 'image')) {
                $model->image = UploadedFile::getInstances($model, 'image');
                 $screen = $model->photo();
                $model->image = $screen;
            } else {
                $model->image = Yii::$app->user->identity->image;
            }
            $model->save(false);
            return $this->redirect(['profile']);

        } else {
            return $this->render('AgentEditForm', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionAccount()
    {
        $model = Users::find()->where(['id'=>Yii::$app->user->identity->getId()])->one();

        if ($model->load(Yii::$app->request->post()))
        {
           // echo  $model->setPassword($model->password_write);
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_write);
            //$password =  Yii::$app->security->generatePasswordHash($model['password_write']);
            //$model->password_hash = $password;

            $model->save(false);
            return $this->redirect(['profile']);

        } else {
            return $this->render('account_settings', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Property the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Property::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
