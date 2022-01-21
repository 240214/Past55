<?php

namespace frontend\controllers;

use Yii;
use common\models\CustomerAddresses;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use common\models\Property;

/**
 * CustomerController implements the CRUD actions for CustomerAddresses model.
 */
class CustomerController extends BaseController{
	
	/**
	 * {@inheritdoc}
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
	 * Creates a new CustomerAddresses model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionAddressStore(){
		Yii::$app->response->format = Response::FORMAT_JSON;
		$response = ['error' => 1, 'ids' => []];
		
		$session = Yii::$app->session;
		$request = Yii::$app->request->post();
		$user_id = (Yii::$app->user->identity) ? Yii::$app->user->identity->getId() : 0;
		$sid = $session->getId();
		
		if(!empty($request['CustomerAddresses']['id'])){
			foreach($request['CustomerAddresses']['id'] as $k => $id){
				
				//$_data = $request;
				$_data['CustomerAddresses']['id'] = $request['CustomerAddresses']['id'][$k];
				$_data['CustomerAddresses']['sid'] = $sid;
				$_data['CustomerAddresses']['user_id'] = $user_id;
				$_data['CustomerAddresses']['title'] = $request['CustomerAddresses']['title'][$k];
				$_data['CustomerAddresses']['address'] = $request['CustomerAddresses']['address'][$k];
				$_data['CustomerAddresses']['lat'] = $request['CustomerAddresses']['lat'][$k];
				$_data['CustomerAddresses']['lng'] = $request['CustomerAddresses']['lng'][$k];
				
				if(!empty($_data['CustomerAddresses']['title']) && !empty($_data['CustomerAddresses']['address']) && !empty($_data['CustomerAddresses']['lat']) && !empty($_data['CustomerAddresses']['lng'])){
					if(intval($id) > 0){
						$model = CustomerAddresses::findOne($id);
					}else{
						$model = new CustomerAddresses();
					}
					
					if($model->load($_data) && $model->save()){
						$response['ids'][$k] = $model->id;
						$response['error']   = 0;
					}
					
					unset($model);
				}
			}
		}
		
		return $response;
	}
	
	/**
	 * Deletes an existing CustomerAddresses model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionAddressRemove(){
		$session = Yii::$app->session;
		
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request->post();
		$response = ['error' => 0, 'id' => $request['id']];
		
		/*$model = $this->findModel($request['id']);
		$response['model'] = $model;
		
		CustomerAddresses::deleteAll([
			'sid' => $session->getId(),
			'title' => $model->title,
			'address' => $model->address,
			'lat' => $model->lat,
			'lng' => $model->lng,
		]);*/
		
		$this->findModel($request['id'])->delete();
		
		return $response;
	}
	
	/**
	 * @return array
	 * @throws NotFoundHttpException
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 */
	public function actionAddressLoad(){
		$response = ['error' => 0, 'data' => []];
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request->post();
		
		$model = $this->findModel($request['address_id']);
		
		$properties = Property::find()
			->select(['id', 'address_lat', 'address_lng'])
			->where(['IN', 'id', $request['props_ids']])
			->asArray()
			->all();
		
		foreach($properties as $k => $property){
			$response['data'][$k] = [
				'id' => $property['id'],
				'address_id' => $model->id,
				'title' => $model->title,
				'address' => $model->address,
				'distance' => Yii::$app->Helpers->distance($property['address_lat'], $property['address_lng'], $model->lat, $model->lng, 'M'),
				'distance_type' => CustomerAddresses::$distance_type,
				#'prop_coords' => [$property['address_lat'], $property['address_lng']],
				#'address_coords' => [$model->lat, $model->lng],
			];
		}
		
		unset($properties, $model, $request);
		
		return $response;
	}
	
	/**
	 * Finds the CustomerAddresses model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return CustomerAddresses the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if(($model = CustomerAddresses::findOne($id)) !== null){
			return $model;
		}
		
		throw new NotFoundHttpException('The requested page does not exist.');
	}
	
}
