<?php

namespace backend\controllers;

use common\models\Category;
use common\models\CategoryLink;
use common\models\Property;
use common\models\PropertyFeatures;
use common\models\search\SearchProperty;
use common\models\AdmnLoginForm;
use common\models\AmbeInqueryVisitor;
use common\models\Blog;
use common\models\State;
use common\models\Country;
use common\models\Track;
use common\models\City;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use common\models\NearbyPlacesTypes;
use common\models\NearbyPlaces;
use yii\helpers\Json;

/**
 * AdsController implements the CRUD actions for Property model.
 */
class PropertyController extends Controller{
	
	public $default_pageSize = 20;
	public $pageSize_list = [7 => 7, 10 => 10, 20 => 20, 30 => 30, 40 => 40, 50 => 50, 100 => 100];
	
	/**
	 * {@inheritdoc}
	 */
	public function behaviors(){
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'  => ['detete', 'edit', 'update', 'property', 'remove-image'],
				'rules' => [
					[
						'actions' => ['detete', 'update', 'edit', 'property', 'remove-image'],
						'allow'   => true,
						'roles'   => ['@'],
					],
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
					'remove-image' => ['POST'],
				],
			],
		];
	}
	
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
	
	/**
	 * Lists all Property models.
	 * @return mixed
	 */
	public function actionIndex(){
		if(Yii::$app->user->isGuest){
			return $this->goHome();
		}
		
		$pageSize = Yii::$app->request->get('per-page') ? intval(Yii::$app->request->get('per-page')) : $this->default_pageSize;
		
		$searchModel = new SearchProperty();
		
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
		$dataProvider->pagination->pageSize = $pageSize ? $pageSize : $this->default_pageSize;
		
		$statesModel = State::find()->all();
		$all_states = ArrayHelper::map($statesModel, 'name', 'iso_code');
		
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
			'pageSize' => $pageSize,
			'pageSize_list' => $this->pageSize_list,
			'property_types' => $searchModel->getPropertyTypes(),
			'property_of_types' => $searchModel->getPropertyOfTypes(),
			'categories' => $searchModel->getFilterCategories(),
			'all_states' => $all_states,
			#'sub_categories' => $searchModel->getFilterSubCategories(),
		]);
	}
	
	/**
	 * Displays a single Property model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id){
		
		$model = $this->findModel($id);
		
		return $this->render('view', [
			'model' => $model,
			#'property_types' => $model->getPropertyTypes(),
			#'property_of_types' => $model->getPropertyOfTypes(),
			#'categories' => $model->getCategories(),
		]);
	}
	
	/**
	 * Creates a new Property model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate(){
		$model = new Property();
		
		$request = Yii::$app->request->post();
		$request['Property']['user_id'] = Yii::$app->user->id;
		
		if($model->load($request)){
			if(!empty($model->features)){
				$model->features = implode(",", array_filter($model->features));
			}
			if(!empty($model->office_hours)){
				$model->office_hours = Json::encode($model->office_hours);
				#VarDumper::dump($model->office_hours, 10, 1); exit;
			}
			if($model->save()){
				$this->addNewLocationEntries($model->city, $model->state, $model->country);
				
				return $this->redirect(['view', 'id' => $model->id]);
			}else{
				#VarDumper::dump($model->getErrors(), 10, 1); exit;
			}
		}
		
		$model->nearby_places = $this->getActiveNearbyPlaces(true, $model->id);
		$model->nearby_places_types = $this->getActiveNearbyPlacesTypes();
		
		return $this->render('create', [
			'model' => $model
		]);
	}
	
	/**
	 * Updates an existing Property model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id){
		$model = $this->findModel($id);
		
		if($model->load(Yii::$app->request->post())){
			#VarDumper::dump(Yii::$app->request->post(), 10, 1); exit;
			if(!empty($model->features)){
				$model->features = implode(",", array_filter($model->features));
			}
			if(!empty($model->office_hours)){
				$model->office_hours = Json::encode($model->office_hours);
			}
			if($model->save(false)){
				$this->addNewLocationEntries($model->city, $model->state, $model->country);
				
				return $this->redirect(['view', 'id' => $model->id]);
			}
		}
		
		if(!empty($model->screenshot) && !is_array($model->screenshot)){
			$model->screenshot = explode(",", $model->screenshot);
		}
		
		$model->nearby_places = $this->getActiveNearbyPlaces(true, $model->id);
		$model->nearby_places_types = $this->getActiveNearbyPlacesTypes();
		
		return $this->render('update', [
			'model' => $model
		]);
	}
	
	public function addNewLocationEntries($city, $state, $country){
		if(!empty($country)){
			$model_country = Country::find()->where(['name' => $country])->one();
			if(is_null($model_country)){
				$model_country         = new Country();
				$model_country['name'] = $country;
				$model_country->save(false);
			}
			
			if(!empty($state)){
				$model_state = State::find()->where(['name' => $state, 'country_id' => $model_country->id])->one();
				if(is_null($model_state)){
					$model_state               = new State();
					$model_state['name']       = $state;
					$model_state['iso_code']   = strtoupper(mb_substr($state, 0, 2, 'utf-8'));
					$model_state['country_id'] = $model_country->id;
					$model_state->save(false);
				}
				
				if(!empty($city)){
					$model_city = City::find()->where(['name' => $city, 'state_id' => $model_state->id])->one();
					if(is_null($model_city)){
						$model_city             = new City();
						$model_city['name']     = $city;
						$model_city['state_id'] = $model_state->id;
						$model_city->save(false);
					}
				}
			}
		}
	}
	
	/**
	 * Deletes an existing Property model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 */
	public function actionDelete($id){
		$this->findModel($id)->delete();
		
		return $this->redirect(['index']);
	}
	
	/**
	 * Finds the Property model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Property the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if(($model = Property::findOne($id)) !== null){
			return $model;
		}
		
		throw new NotFoundHttpException('The requested page does not exist.');
	}

	public function actionGetCatsFragments($id){
		$ret = ['error' => 0];
		
		Yii::$app->response->format = 'json';
		$request_data = Yii::$app->request->post('data');
		
		if(Yii::$app->request->isAjax){
			$model = $this->findModel($id);
			
			$listCategory = Category::find()->where(['type' => $request_data['type']])->orderBy('type DESC', 'name ASC')->all();
			$a = [];
			foreach($listCategory as $item){
				$selected = $model->category_id == $item->id ? 'selected="selected"' : '';
				$a[] = '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
			}
			$ret['category_ids'] = implode('', $a);
			
			$listLinks = CategoryLink::find()->where(['property_id' => $id])->all();
			$category_links = ArrayHelper::map($listLinks, 'id', 'category_id');
			$a = [];
			foreach($listCategory as $index => $item){
				$checked = (in_array($item->id, $category_links)) ? 'checked' : '';
				
				$content = '<div class="check-item" data-id="'.$item->id.'">';
				$content .= Html::checkbox('Property[categories][]', $checked, ['value' => $item->id, 'id' => 'item_'.$index]);
				$content .= '<label for="item_'.$index.'"><i class="fa fa-check"></i>'.$item->name.'</label>';
				$content .= '</div>';
				
				$a[] = $content;
			}
			$ret['categories'] = implode('', $a);
		}
		
		return $ret;
	}
	
	public function actionRemoveImage($id){
		$ret = ['error' => 0];
		
		Yii::$app->response->format = 'json';
		$request_data = Yii::$app->request->post('data');
		
		if(Yii::$app->request->isAjax){
			$model = $this->findModel($id);
			
			switch($request_data['field']){
				case "screenshot":
					if(!$this->removeGalleryImage($model, $request_data))
						$ret['error'] = 1;
					break;
				case "image":
					if(!$this->removeMainImage($model, $request_data))
						$ret['error'] = 1;
					break;
				case "floorplan":
					break;
			}
			
			return $ret;
		}
	}
	
	private function removeGalleryImage($model, $data){
		$ret = false;
		
		if(!is_array($model->screenshot)){
			$screenshots = explode(',', $model->screenshot);
		}
		
		if(in_array($data['file'], $screenshots)){
			$screenshots = array_flip($screenshots);
			
			unset($screenshots[$data['file']]);
			
			$screenshots = !empty($screenshots) ? implode(',', array_flip($screenshots)) : '';
			
			$model->screenshot = $screenshots;
			
			if($ret = $model->save(false)){
				$this->removeImageFile($data);
			}
		}
		
		return $ret;
	}
	
	private function removeMainImage($model, $data){
		$model->image = '';

		if($ret = $model->save(false)){
			$this->removeImageFile($data);
		}
		
		return $ret;
	}
	
	private function removeImageFile($data){
		$dir = Yii::getAlias('@property_images').'/';
		
		
		$files = [
			$dir.$data['id'].'/'.$data['file'],
			$dir.$data['id'].'/thumbs/'.$data['file']
		];
		
		$thumbs_directory = array_diff(scandir($dir.$data['id'].'/thumbs/'), ['..', '.']);
		if(!empty($thumbs_directory)){
			foreach($thumbs_directory as $file){
				if(strstr($file, pathinfo($data['file'])['filename']) !== false){
					$files[] = $dir.$data['id'].'/thumbs/'.$file;
				}
			}
		}
		
		foreach($files as $file)
			if(file_exists($file))
				FileHelper::unlink($file);
	}
	
	private function getActiveNearbyPlacesTypes($toJson = true){
		$ret = [];
		
		$model = NearbyPlacesTypes::find()->where(['active' => 1])->all();
		
		if($model){
			foreach($model as $row)
				$ret[] = $row->name;
		}
		
		if($toJson)
			$ret = Json::encode($ret);
		
		return $ret;
	}
	
	private function getActiveNearbyPlaces($toJson = true, $property_id){
		$ret = [];
		
		$model = NearbyPlaces::find()->where(['property_id' => $property_id, 'active' => 1])->all();
		
		if($model){
			$ret = $model;
		}
		
		if($toJson)
			$ret = Json::encode($ret);
		
		return $ret;
	}
	
	public function actionSetStatus($id){
		$ret = ['error' => 0, 'status' => ''];
		
		Yii::$app->response->format = 'json';
		
		if(Yii::$app->request->isAjax){
			$model = $this->findModel($id);
			$model->active = Yii::$app->request->post('active') == 'true' ? 1 : 0;
			if(!$model->save(false)){
				$ret['error'] = 1;
			}
		}
		
		return $ret;
	}
	
}
