<?php

namespace frontend\controllers;

use Yii;
use common\models\Property;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\Response;
use common\models\FavoriteProperties;

class FavoritesController extends BaseController{
	
	/**
	 * @inheritdoc
	 */
	public function behaviors(){
		return [
			'verbs' => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}
	
	/**
	 * Toggle save to favorites or remove from favorites
	 * @return array
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 */
	public function actionProperty(){
		$response = ['error' => 0, 'result' => ['checked' => 0, 'count' => 0, 'user_favs_count' => 0]];
		
		Yii::$app->response->format = Response::FORMAT_JSON;
		
		$request = Yii::$app->request->post();
		$pid     = $request['property_id'];
		$uid     = (Yii::$app->user->identity) ? Yii::$app->user->identity->getId() : 0;
		$sid     = Yii::$app->session->id;
		
		$response['sid']         = $sid;
		$response['user_id']     = $uid;
		$response['property_id'] = $pid;
		
		$model = FavoriteProperties::find()
			#->where(['user_id' => $uid])
            ->orWhere(['sid' => $sid])
            ->andWhere(['property_id' => $pid])
            ->one();
		
		$property = Property::findOne($pid);
		#$response['property'] = $property;
		
		if($model){
			$model->delete();
			if(intval($property->likes) > 0){
				$property->likes = intval($property->likes) - 1;
			}else{
				$property->likes = 0;
			}
			$property->save(false);
			
			$response['result']['checked'] = 0;
			$response['result']['count'] = $property->likes;
		}else{
			$model              = new FavoriteProperties();
			$model->property_id = $pid;
			$model->user_id     = $uid;
			$model->sid         = $sid;
			if($model->save(false)){
				$property->likes    = intval($property->likes) + 1;
				$property->save(false);
				
				$response['result']['checked'] = 1;
				$response['result']['count'] = $property->likes;
			}else{
				$response['error'] = 1;
			}
		}
		
		$response['result']['user_favs_count'] = FavoriteProperties::find()->where(['sid' => $sid])->count();
		
		return $response;
	}
	
	public function actionIndex(){
		$noindex = YII_ENV_DEV;
		
		#$uid     = (Yii::$app->user->identity) ? Yii::$app->user->identity->getId() : 0;
		$sid     = Yii::$app->session->id;
		
		$models = Property::find()
			->leftJoin('favorite_properties', 'favorite_properties.property_id = properties.id')
			#->where(['favorite_properties.user_id' => $uid])
			->where(['favorite_properties.sid' => $sid])
			->all();
		
		return $this->render('index', [
			'models' => $models,
			'meta' => [
				'title' => 'Favorites',
				'description' => '',
				'keywords' => '',
				'noindex' => $noindex,
			],
		]);
	}
	
}
