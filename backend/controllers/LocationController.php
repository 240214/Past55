<?php

namespace backend\controllers;

use backend\models\CityForm;
use backend\models\CitySearchForm;
use common\models\City;
use common\models\Contact;
use common\models\Country;
use common\models\Faq;
use common\models\MainMenu;
use common\models\Product;
use common\models\State;
use common\models\Track;
use Yii;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\User;

/**
 * Settings controller
 */


define('LOGO_W', 223);
define('LOGO_H', 50);
define('FAV_ICON_SIZE', 10);

class LocationController extends Controller{
	
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
	
	public function actionIndex(){
		return $this->render('index');
	}
	
	public function actionState(){
		//Country
		$cat = new State();
		if($cat->load(Yii::$app->request->post())){
			$cat->save(false);
			Yii::$app->session->setFlash('success', 'save settings');
		}
		
		$query      = State::find()->orderBy(['id' => SORT_ASC]);
		$countQuery = clone $query;
		$pages      = new Pagination(['totalCount' => $countQuery->count()]);
		$models     = $query->offset($pages->offset)->limit($pages->limit)->all();
		
		
		return $this->render('state', [
			'model' => $models,
			'pages' => $pages,
			'cat'   => $cat
		
		
		]);
	}
	
	public function actionCity(){
		
		$cat        = new CityForm();
		$serachCity = new CitySearchForm();
		
		
		if($cat->load(Yii::$app->request->post())){
			$newCity           = new City();
			$newCity->state_id = $cat->state_id;
			$newCity->name     = $cat->city;
			$newCity->save(false);
			Yii::$app->session->setFlash('success', 'save settings');
		};
		
		
		if($serachCity->load(Yii::$app->request->post())){
			// echo $serachCity->state_id;die;
			$country = Country::find()->where(['id' => $serachCity->country_id])->one();
			$query   = City::find()->where(['state_id' => $serachCity->state_id])->orderBy(['id' => SORT_ASC]);
			$query2  = City::find()->where(['state_id' => $serachCity->state_id])->orderBy(['id' => SORT_ASC])->all();
			
			$countQuery = clone $query;
			$pages      = new Pagination(['totalCount' => $countQuery->count()]);
			$models     = $query->offset($pages->offset)->limit($pages->limit)->all();
			
			
			return $this->render('city', [
				'model'      => $query2,
				'pages'      => $pages,
				'cat'        => $cat,
				'serachCity' => $serachCity,
				'country'    => $country,
				'pager'      => false
			]);
		};
		
		$query      = City::find()->orderBy(['id' => SORT_ASC]);
		$countQuery = clone $query;
		$pages      = new Pagination(['totalCount' => $countQuery->count()]);
		$models     = $query->offset($pages->offset)->limit($pages->limit)->all();
		
		
		return $this->render('city', [
			'model'      => $models,
			'pages'      => $pages,
			'cat'        => $cat,
			'serachCity' => $serachCity,
			'country'    => false,
			'pager'      => true
		
		]);
		
	}
	
	public function actionFormState($id){
		$state = State::find()->where(['country_id' => $id])->all();
		$count = count($state);
		
		if($count > 0){
			echo "<option value='other'> Other</option>";
			foreach($state as $name){
				echo "<option value='".$name['id']."'>".$name['name']."</option>";
			}
			
		}else{
			echo "<option value='1'> other </option>";
		}
	}
	
	
}
