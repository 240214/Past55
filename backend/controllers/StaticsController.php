<?php
namespace backend\controllers;

use common\models\Property;
use common\models\Category;
use common\models\SubCategory;
use common\models\Track;
use common\models\Type;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * StaticsController
 */
class StaticsController extends Controller
{


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

    public function actionIndex()
    {


        $count = Track::find()->count();
        $pages = new Pagination(['totalCount' => $count,'pageSize'=>10]);
        $track = Track::find()->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',[
            'track'=>$track,
            'pages' => $pages,
            'count'=>$count,
        ]);

    }






}
