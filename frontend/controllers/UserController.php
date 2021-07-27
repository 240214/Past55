<?php

namespace frontend\controllers;

use common\models\SavedAgents;
use common\models\UserRating;
use common\models\UserReview;
use frontend\models\ContactForm;
use frontend\models\SearchAgentsForm;
use Yii;
use common\models\Property;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use frontend\controllers\BaseController;

/**
 * PropertyController implements the CRUD actions for User model.
 */
define('USER_IMG', Yii::getAlias('@webroot') .'/images/user/');

class UserController extends BaseController
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
    public function beforeAction($action) {
        $actionToRun = $action;
        if($actionToRun->id == "delete")
        {
            #Yii::$app->session->setFlash('error', 'Sorry, You cannot Edit/delete record in demo version');

        }
         // var_dump($actionToRun->id) ;die;

        return parent::beforeAction($action);
    }
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {

        $agents = User::find()->all();
        $findAgent = new User();
        if ($findAgent->load(Yii::$app->request->post()))
        {
            $searchResult = User::find()
                ->where(['city'=>$findAgent->city])
                ->andWhere(['deal_property_type'=>$findAgent->deal_property_type])
                ->andWhere(['dealing_in'=>$findAgent->dealing_in])->all();
            if($searchResult)
            {
                return $this->render('index', [
                    'agents'=>$searchResult,
                    'findAgents'=>$findAgent
                ]);
            }
            else
            {
                $searchResult = User::find()
                    ->where(['city'=>$findAgent->city])
                    ->orWhere(['deal_property_type'=>$findAgent->deal_property_type])
                    ->orWhere(['dealing_in'=>$findAgent->dealing_in])->limit(5)->all();
                return $this->render('no-results', [
                    'agentsSuggestion'=>$searchResult,
                ]);

            }

        }
        return $this->render('index', [
            'agents'=>$agents,
            'findAgents'=>$findAgent
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
//   all agent list displayed  below########
    public function actionAgents()
    {

        $model = User::find()->where(['role'=>'agent'])->all();;

        $serach = new SearchAgentsForm();
        if ($serach->load(Yii::$app->request->post()))
        {
            $find = User::find()->where(['profile_status'=>'active']);
            if($serach->role)
            {
                $find->andWhere(['role'=>$serach->role]);
            }
            if($serach->location)
            {
                $find->andWhere(['city'=>$serach->location]);
            }
            if($serach->agent_type)
            {
                $find->andWhere(['agent_type'=>$serach->agent_type]);
            }
            if($serach->languages)
            {
                $find->andWhere(['languages'=>$serach->languages]);
            }
            if($serach->price_min)
            {
                $find->andWhere(['>=','price_min',$serach->price_min]);
            }
            if($serach->price_max)
            {
                $find->andWhere(['<=','price_max',$serach->price_max]);
            };

            $serachResults = $find->all();
            return $this->render('agents', [
                'agent' => $serachResults,
                'search'=>$serach
            ]);

        }
        return $this->render('agents', [
            'agent' => $model,
            'search'=>$serach
        ]);
    }


//    agent detail profile displayed  below########
    public function actionProfile($id = false,$username=false)
    {
        if(!$username and !$id)
        {
            $model = User::findOne(Yii::$app->user->identity->getId());

        }
        elseif($id == true)
        {
            $model = User::find()->where(['id'=>$username])->one();
        }
        else
        {
            $model = User::findByUsername($username);

        };
        $fvrt = SavedAgents::find()->where(['agent_id'=>$model['id']])->count();

        $rating = UserRating::find()->where(['agent_id'=>$model['id']])->one();
        $total_reviews = UserReview::find()->where(['agent_id'=>$model['id']])->count();


        $property = Property::find()->where(['user_id'=>$model['id']])->all();
        $listing = Property::find()->where(['user_id'=>$model['id']])->count();
        $sold = Property::find()->where(['user_id'=>$model['id']])->andWhere(['sold'=>'yes'])->count();

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
        if($username)
        {
            $view = "agent_detail";
        }
        else
        {
            $view = ($model->role == "agent")?"agent_detail":"guest_detail";

        }

        return $this->render($view, [
            'agent' => $model,
            'property'=>$property,
            'listing'=>$listing,
            'sold'=>$sold,
            'fvrt'=>$fvrt,
            'rating'=>$rating,
            'total_review'=>$total_reviews
        ]);
    }

    //    agent detail property displayed below ########
    public function actionProperty($username=false)
    {
        $model = User::findByUsername($username);

        $listing = Property::find()->where(['user_id'=>$model['id']])->all();
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
        return $this->render('agent_detail_property', [
            'agent' => $model,
            'listing'=>$listing,
            'rating'=>$rating,
            'total_review'=>$total_reviews
        ]);
    }


    public function actionU($user=false)
    {
        $user = empty($user)?Yii::$app->user->identity->username:$user;
        $model = User::findByUsername($user);
        $property = Property::find()->where(['user_id'=>$model['id']])->all();
        return $this->render('agent_detail', [
            'agent' => $model,
            'property'=>$property
        ]);
    }

    public function actionReview($user)
    {
        $user = $user;
        $model = User::findByUsername($user);
        $reviewform = new UserReview();


        if($reviewform->load(Yii::$app->request->post()))
        {
            if (Yii::$app->user->isGuest)
            {
                Yii::$app->session->setFlash('danger', '<stronge>Login or signup!</stronge> Login for giving the review.');

                return $this->redirect(Url::toRoute($user.'/review'));

            };
            $checkReviewExist = UserReview::find()->where(['agent_id'=>$model->id])->andWhere(['user_id'=>Yii::$app->user->identity->getId()])->one();
            if ($checkReviewExist)
            {
                Yii::$app->session->setFlash('warning', '<b>Waring!</b> Your Reviwe for this agent is already present in the our system. Thanks for your effort..');

                return $this->redirect(Url::toRoute($user.'/review'));
            };

            $all =  ( $reviewform->market_knowledge + $reviewform->resnonsiveness + $reviewform->trustworthness + $reviewform->negotiation_skill);
            $avrg = $all/4;
            $reviewform->overall = $avrg;
            $reviewform->user_id = Yii::$app->user->identity->getId();
            $reviewform->name = Yii::$app->user->identity->username;
            $reviewform->review_at = time();
            $reviewform->agent_id = $model->id;

           //overall rating and review added
            $findUserRating = UserRating::find()->where(['agent_id'=>$model->id])->one();

            /// //////////////////////////////////////////////////////////////////////////////////////////////////////
            /////////////////########### fetch the current review and rating #####################////////////////////
            /// //////////////////////////////////////////////////////////////////////////////////////////////////////
            $count_market_knowledge = UserReview::find()->where(['agent_id'=>$model->id])->sum('market_knowledge');
            $count_resnonsiveness= UserReview::find()->where(['agent_id'=>$model->id])->sum('resnonsiveness');
            $count_negotiation_skill= UserReview::find()->where(['agent_id'=>$model->id])->sum('negotiation_skill');
            $count_trustworthness= UserReview::find()->where(['agent_id'=>$model->id])->sum('trustworthness');
            $count_total = UserReview::find()->where(['agent_id'=>$model->id])->sum('overall');

            /// //////////////////////////////////////////////////////////////////////////////////////////////////////
            /////////////////########### fetch the current review and rating end #####################////////////////////
            /// //////////////////////////////////////////////////////////////////////////////////////////////////////

           $reviewSave = $reviewform->save(false);
            if($reviewSave)
            {
                if($findUserRating)
                {
                    $new_rate = $findUserRating->rating + 1;


                    $findUserRating->market_knowledge = ($count_market_knowledge + $reviewform->market_knowledge)/$new_rate;
                    $findUserRating->resnonsiveness = ($count_resnonsiveness + $reviewform->resnonsiveness)/$new_rate;
                    $findUserRating->negotiation_skill = ($count_negotiation_skill + $reviewform->negotiation_skill)/$new_rate;
                    $findUserRating->trustworthness = ($count_trustworthness + $reviewform->trustworthness)/$new_rate;
                    $findUserRating->overall = ($count_total + $reviewform->overall)/$new_rate;
                    $findUserRating->rating = $new_rate;

                    // echo ($count_total + $reviewform->overall)/$new_rate ;//($count_total + $reviewform->overall)/$new_rate;
                    // die();
                    $findUserRating->save(false);
                    Yii::$app->session->setFlash('success', '<stronge>Success!</stronge> Your review is successfully added. thankx for this review.');

                }
                else
                {
                    $userRating = new UserRating();
                    $userRating->agent_id = $model->id;
                    $userRating->rating = "1";
                    $userRating->market_knowledge = $reviewform->market_knowledge;
                    $userRating->resnonsiveness = $reviewform->resnonsiveness;
                    $userRating->negotiation_skill = $reviewform->negotiation_skill;
                    $userRating->trustworthness = $reviewform->trustworthness;
                    $userRating->overall =$avrg;
                    $userRating->save(false);
                }
            }
            else
            {
                //var_dump($reviewSave);die;
                Yii::$app->session->setFlash('danger', '<stronge>Eror!</stronge> Your review is not added.please try letter.');

            }
            //end * reviwe and rating
        }

        /// //////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////########### contact form submission #####################////////////////////
        /// //////////////////////////////////////////////////////////////////////////////////////////////////////
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
        /// //////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////########### contact form submission end #####################////////////////////
        /// //////////////////////////////////////////////////////////////////////////////////////////////////////
        $reviews = UserReview::find()->where(['agent_id'=>$model->id])->all();
        $total_reviews = UserReview::find()->where(['agent_id'=>$model->id])->count();
        $rating = UserRating::find()->where(['agent_id'=>$model->id])->one();

        return $this->render('agent_detail_review', [
            'agent' => $model,
            'review'=>$reviewform,
            'reviews'=>$reviews,
            'total_review'=>$total_reviews,
            'rating'=>$rating
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
        $model = User::findOne(Yii::$app->user->identity->getId());

        if ($model->load(Yii::$app->request->post())) {

            if (UploadedFile::getInstances($model, 'image')) {
//                $model->image = UploadedFile::getInstances($model, 'image');
//                 $screen = $model->photo();
//                $model->image = $screen;
            } else {
                $model->image = Yii::$app->user->identity->image;
            }
            Yii::$app->session->setFlash('error', 'Sorry, You cannot Edit/delete record in demo version');

            // $model->save(false);
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
        $model = User::find()->where(['id'=>Yii::$app->user->identity->getId()])->one();

        if ($model->load(Yii::$app->request->post()))
        {
           // echo  $model->setPassword($model->password_write);
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_write);
            //$password =  Yii::$app->security->generatePasswordHash($model['password_write']);
            //$model->password_hash = $password;
            Yii::$app->session->setFlash('error', 'Sorry, You cannot Edit/delete record in demo version');

           // $model->save(false);
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
        //$this->findModel($id)->delete();

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
