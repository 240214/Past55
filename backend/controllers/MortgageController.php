<?php
namespace backend\controllers;

use common\models\Property;
use common\models\AdmnLoginForm;
use common\models\Mortgage;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Settings controller
 */


define('LOGO_W', 223);
define('LOGO_H',50);
define('FAV_ICON_SIZE', 10);


/**
 * Mortgage controller
 */
class MortgageController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['delete', 'edit','update'],
                'rules' => [
                    [
                        'actions' => ['delete', 'edit','update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],


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
        $model = Mortgage::find()->all();

       // $chatInquery  = AmbeInqueryVisitor::find()->all();
        return $this->render('index',['model'=>$model]);
    }

    /**
     * Displays index.
     *
     * @return string
     */
    public function actionNew()
    {
        $model = new Mortgage();
        if ($model->load(Yii::$app->request->post()))
        {
            //$model->
            if(UploadedFile::getInstance($model,'bank_logo') != null)
            {
                $model->bank_logo = UploadedFile::getInstance($model, 'bank_logo');
                $logo = $model->uploadLogo();
                $model->bank_logo = $logo;
            }
            $model->save(false);
            Yii::$app->getSession()->setFlash('success', 'Update successfully');
            return $this->refresh();

        }
        return $this->render('new',['model'=>$model]);

    }
    /**
     * Displays index.
     *
     * @return string
     */
    public function actionDelete($id)
    {
        $delete = Mortgage::findOne($id);
       // $delete->delete();
        Yii::$app->getSession()->setFlash('success', 'Update successfully');

        return $this->redirect(Url::toRoute('mortgage/index'));

    }
    /**
     * Displays index.
     *
     * @return string
     */
    public function actionEdit($id)
    {
        $bkp = Mortgage::findOne($id);
        $model = Mortgage::findOne($id);
        if ($model->load(Yii::$app->request->post()))
        {
            //$model->
            if(UploadedFile::getInstance($model,'bank_logo') != null)
            {
                $model->bank_logo = UploadedFile::getInstance($model, 'bank_logo');
                $logo = $model->uploadLogo();
                $model->bank_logo = $logo;
            }
            else
            {
                $model->bank_logo = $bkp->bank_logo;;
            }
            $model->save(false);
            Yii::$app->getSession()->setFlash('success', 'Update successfully');
            return $this->redirect(Url::toRoute('mortgage/index'));

        }
        return $this->render('new',['model'=>$model]);
    }
}
