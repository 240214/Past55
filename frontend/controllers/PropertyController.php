<?php

namespace frontend\controllers;

use common\models\NearbyPlaces;
use common\models\NearbyPlacesTypes;
use common\models\PropertyFeatures;
use common\models\search\SearchProperty;
use Yii;
use common\models\Property;
use common\models\Category;
use common\models\Users;
use common\models\Views;
use frontend\models\ContactForm;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\db\Query;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use common\models\State;
use yii\web\Response;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use common\models\CustomerAddresses;
use frontend\controllers\BaseController;
use common\models\FavoriteProperties;
use common\models\PropertyFeaturesTypes;
use common\models\City;
use common\models\CategoryCityContent;

class PropertyController extends BaseController {
	
	public $default_pageSize = 14;
	public $customer_all_addresses = [];
	
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
	 * @inheritdoc
	 */
	public function actions(){
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			/*'captcha' => [
				'class'           => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],*/
		];
	}
	
	/**
	 * Lists all Property models.
	 * @return mixed
	 * @throws \yii\base\InvalidConfigException
	 */
	public function actionIndex(){
		$city = $state = $category = '';
		$category_id = $state_id = $city_id = 0;
		$category_ids = [];
		$noindex = YII_ENV_DEV;
		$display_narrow_cities = false;
		$display_nearby_cities = false;
		$session = Yii::$app->session;
		
		#$request = Yii::$app->request;
		#VarDumper::dump($request, 10, 1); exit;
		#VarDumper::dump($queryParams, 10, 1); exit;
		
		$categories = Category::getCategoryList([
			'fields' => ['id', 'name', 'slug', 'meta_title', 'template'],
			'key_field' => 'slug',
			'order' => 'name ASC',
		]);
		#VarDumper::dump($categories, 10, 1); exit;
		
		$url = Yii::$app->request->getUrl();
		if(strstr($url, 'page') !== false){
			$url = explode('page', $url)[0];
		}
		
		$queryParams = Yii::$app->request->getQueryParams();
		#VarDumper::dump($queryParams, 10, 1); exit;
		
		$breadcrumbs = $this->generateBreadcrumbs($queryParams);
		
		if(isset($queryParams['state'])){
			$state_id = State::getIDByIso($queryParams['state']);
			$states = State::getStatesIsoNameList();
			$state = $states[strtoupper($queryParams['state'])];
			$queryParams['state'] = $state;
		}
		#VarDumper::dump($state_id, 10, 1); exit;
		
		if(isset($queryParams['city'])){
			$city_id = City::getIDByName($queryParams['city']);
			$city = ucfirst($queryParams['city']);
			$queryParams['city'] = $city;
			$display_nearby_cities = true;
		}else{
			$display_narrow_cities = true;
		}
		#VarDumper::dump($city_id, 10, 1); exit;
		
		if(isset($queryParams['category'])){
			$category_id = $categories[$queryParams['category']]['id'];
			if(count($queryParams) == 1){
			
			}
			$category_ids[] = $categories[$queryParams['category']]['id'];
			$queryParams['category_ids'] = $category_ids;
			$category = $categories[$queryParams['category']]['meta_title'];
		}
		#VarDumper::dump($category_id, 10, 1); exit;
		
		if(isset($queryParams['categories'])){
			$cats = explode('-and-', $queryParams['categories']);
			foreach($cats as $cat){
				$category_ids[] = $categories[$cat]['id'];
			}
			$category_ids = array_filter($category_ids);
			$queryParams['category_ids'] = $category_ids;
			unset($queryParams['categories']);
			$noindex = true;
		}
		
		#$queryParams['per-page'] = $pageSize;
		#$queryParams['page'] = isset($queryParams['page']) ? $queryParams['page'] : 0;
		$queryParams['SearchProperty'] = $queryParams;
		$queryParams['SearchProperty']['active'] = 1;
		#VarDumper::dump($queryParams, 10, 1); exit;
		
		$searchModel = new SearchProperty();
		$dataProvider = $searchModel->search($queryParams);
		$dataProvider->sort->defaultOrder = ['id' => SORT_DESC];
		$dataProvider->pagination = [
			'pageParam' => 'page',
			'forcePageParam' => false,
			'pageSizeParam' => false,
			'route' => $url.'page-<page:\d+>/',
			'pageSize' => $this->default_pageSize,
			#'page' => $queryParams['page'],
		];
		
		if(!$dataProvider->getCount()){
			$noindex = true;
		}
		
		$session->set('city', $city);
		$session->set('state', $state);
		$session->set('category_ids', $category_ids);
		
		$narrow_cities = [];
		if($display_narrow_cities){
			if(!$narrow_cities = $this->getNarrowCities($state, $queryParams, $categories)){
				$display_narrow_cities = false;
			}
			#VarDumper::dump($properties, 10, 1); exit;
		}
		
		$nearby_cities = [];
		if($display_nearby_cities){
			if(!$nearby_cities = $this->getNearbyCities($queryParams, $categories)){
				$display_nearby_cities = false;
			}
		}
		
		$category_city_content = $this->get3CContent($category_id, $state_id, $city_id);
		
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
			'categories' => $categories,
			'pagination' => $dataProvider->getPagination(),
			'form_url' => $url,
			'found_label' => $this->generateCountLabel($dataProvider->getTotalCount()),
			'not_found_label' => $this->generateNotFoundLabel($category_ids),
			'meta' => [
				'title' => $this->generateH1Title($state, $city, $category),
				'description' => '',
				'keywords' => '',
				'noindex' => $noindex,
			],
			'breadcrumbs' => $breadcrumbs,
			'display_narrow_cities' => $display_narrow_cities,
			'narrow_cities' => $narrow_cities,
			'display_nearby_cities' => $display_nearby_cities,
			'nearby_cities' => $nearby_cities,
			'category_city_content' => $category_city_content,
		]);
		
	}
	
	public function get3CContent($category_id = 0, $state_id = 0, $city_id = 0){
		$_where = [];
		
		if($category_id > 0)
			$_where['category_id'] = $category_id;
		
		if($state_id > 0)
			$_where['state_id'] = $state_id;
		
		if($city_id > 0)
			$_where['city_id'] = $city_id;
		
		$model = CategoryCityContent::find()->where($_where)->one();
		
		if(!is_null($model)){
			$model->title = $model->FormatedTitle();
			$model->image = $model->getMainImage('full');
		}
		
		return $model;
	}
	
	public function actionCategoryPage(){
		$queryParams = Yii::$app->request->getQueryParams();
		$cat_slug = $queryParams['category'];
		
		$model = Category::find()->where(['slug' => $cat_slug])->one();
		
		if(!is_null($model->template)){
			$path = $model->template;
			$path = str_replace(['/views'], [''], $path);
			$path = trim($path, '/');
			#VarDumper::dump($path, 10, 1); exit;
			return $this->render($path);
		}else{
			return $this->actionIndex();
		}
		
	}
	
	/**
	 * @param $params
	 *
	 * @return ActiveDataProvider
	 */
	public function actionSearch(){}
	
	public function actionFilter(){
		$ret = ['error' => 0, 'url' => '', 'title' => '', 'html' => ['items' => '', 'pagination' => '', 'narrow_cities' => ''], 'count' => 0, 'found_label' => ''];
		
		$city = $state = $category = '';
		$category_ids = [];
		
		Yii::$app->response->format = Response::FORMAT_JSON;
		
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		
		if($request->isPost){
			$searchModel = new SearchProperty();
			$queryParams = $request->post('Property');
			unset($queryParams['ids'], $queryParams['sort']);
			
			$ret['breadcrumbs'] = Breadcrumbs::widget(['links' => $this->generateBreadcrumbs($queryParams, true)]);
			
			$state = $queryParams['state'];
			$city = $queryParams['city'];
			if(isset($queryParams['category_id'])){
				if(count($queryParams['category_id']) == 1){
					$cat_id = intval(current($queryParams['category_id']));
					$category = Category::find()->select(['id', 'name', 'meta_title'])->where(['id' => $cat_id])->asArray()->one();
					#VarDumper::dump($category, 10, 1); exit;
					$category = $category['meta_title'];
				}
			}
			
			$categories = Category::getCategoryList([
				'fields' => ['id', 'name', 'slug', 'meta_title'],
				'key_field' => 'slug',
				'order' => 'name ASC',
			]);
			if(isset($queryParams['category_id'])){
				$category_ids = $queryParams['category_ids'] = $queryParams['category_id'];
			}
			if(empty($city)){
				$ret['html']['narrow_cities'] = $this->renderPartial('sidebar/narrow-cities-widget', [
					'display_narrow_cities' => true,
					'narrow_cities' => $this->getNarrowCities($state, $queryParams, $categories),
					'with_wrap' => false
				]);
			}else{
				$ret['html']['nearby_cities'] = $this->renderPartial('sidebar/nearby-cities-widget', [
					'display_nearby_cities' => true,
					'nearby_cities' => $this->getNearbyCities($queryParams, $categories),
					'with_wrap' => false
				]);
			}
			
			$url = $this->generateURL($queryParams);
			
			$queryParams['SearchProperty'] = $queryParams;
			$dataProvider = $searchModel->search($queryParams);
			$dataProvider->sort->defaultOrder = ['id' => SORT_DESC];
			$dataProvider->pagination = [
				'pageParam' => 'page',
				'forcePageParam' => false,
				'pageSizeParam' => false,
				'route' => $url.'page-<page:\d+>/',
				'pageSize' => $this->default_pageSize,
			];
			
			$ret['count'] = $dataProvider->getTotalCount();
			$ret['html']['items'] = $this->renderPartial('/property/partials/items', [
				'searchModel'  => $searchModel,
				'models' => $dataProvider->getModels(),
				'options' => [
					'desc_length' => 300,
					'add_to_compare' => false,
					'display_price' => false,
					'display_desc' => false,
					'display_rating' => false,
				],
			]);
			$ret['html']['pagination'] = LinkPager::widget(['pagination' => $dataProvider->getPagination()]);
			$ret['title'] = $this->generateH1Title($state, $city, $category);
			$ret['url'] = $url;
			$ret['found_label'] = $this->generateCountLabel($dataProvider->getTotalCount());
			$ret['not_found_label'] = $this->generateNotFoundLabel($category_ids);
		}
		
		return $ret;
	}
	
	/**
	 * Displays a single Property model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException
	 */
	public function actionView($id, $state = '', $city = '', $slug = ''){
		#VarDumper::dump([$id, $state, $city, $slug]); exit;
		#$session = Yii::$app->session;
		
		
		if(empty($state) || empty($city)){
			#$model = Property::findOne($id);
			#$redirect_url = Url::toRoute(['property/view', 'id' => $model->id, 'slug' => $model->slug, 'state' => $model->state, 'city' => $model->city]);
			#return $this->redirect($redirect_url, 404);
			throw new NotFoundHttpException();
		}
		
		$model = Property::findOne($id);
		$model->views = $model->views + 1;
		$model->save(false);
		
		$view              = new Views();
		$view->user_id     = $model->user_id;
		$view->property_id = $id;
		$view->views       = '1';
		$view->view_time   = date('Y-m-d H:i:s', time());
		$view->save(false);
		
		/*$contact = new ContactForm();
		if($contact->load(Yii::$app->request->post()) && $contact->validate()){
			$email = Users::agentDetail("email", $model['user_id']);
			if($contact->inquiry($email)){
				Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
			}else{
				Yii::$app->session->setFlash('error', 'There was an error sending your message.');
			}
			
			return $this->refresh();
		}*/
		
		if(!empty($model->office_hours)){
			$model->office_hours = Json::decode($model->office_hours, true);
		}
		
		$states = State::getStatesNameIsoList();
		
		$model->nearby_places = $this->getPropertyNearbyPlaces($model);
		$model->categories = $this->getPropertyCategories($model);
		foreach($model->categories as $k => $category){
			$model->categories[$k]['name'] = ucfirst($model->city).' '.$states[$model->state].' '.$model->categories[$k]['name'];
		}
		$model->features = $this->getPropertyFeatures($model);
		$model->liked = $this->getPropertyLiked($model);
		$model->customer_addresses = $this->getCustomerAddresses($model);
		$model->canonical_url = Url::toRoute([
			'property/view',
			'id' => $model->id,
			'slug' => $model->slug,
			'state' => $model->state,
			'city' => $model->city
		], true);
		
		return $this->render('view', [
			'property' => $model,
			#'contact'  => $contact,
		]);
	}
	
	public function generateH1Title($state = '', $city = '', $category = ''){
		$str = 'All Senior Housing in';
		
		if(!empty($category)){
			$str = $category.' in';
		}
		
		if(!empty($city)){
			$str .= ' '.$city;
			if(!empty($state)){
				$str .= ', '.$state;
			}
		}else{
			if(!empty($state)){
				$str .= ' '.$state;
			}
		}
		
		return $str;
	}
	
	public function generateURL($queryParams){
		$ret = Yii::$app->urlManager->getBaseUrl();
		$parts = [];
		
		if(isset($queryParams['state']) && !empty($queryParams['state'])){
			$parts[] = strtolower(State::getStatesIsoByName($queryParams['state']));
		}
		
		if(isset($queryParams['city']) && !empty($queryParams['city'])){
			$parts[] = strtolower($queryParams['city']);
		}
		
		if(isset($queryParams['category_id']) && !empty($queryParams['category_id'])){
			$categories = Category::getCategoryList([
				'fields'    => ['id', 'slug'],
				'key_field' => 'id',
				'order'     => 'name ASC',
			]);
			$c = [];
			foreach($queryParams['category_id'] as $c_id){
				$c[] = $categories[$c_id]['slug'];
			}
			
			$parts[] = implode('-and-', $c);
		}
		
		if(!empty($parts))
			$ret .= "/".implode("/", $parts);
		
		return $ret."/";
	}
	
	public function generateBreadcrumbs($queryParams, $ajax = false){
		$parts = $breadcrumbs = [];
		$state_iso = '';
		
		if(isset($queryParams['category']) && !empty($queryParams['category'])){
			$category = Category::getCategoryBySlug($queryParams['category']);
			$parts[] = $category['slug'];
			$breadcrumbs[] = ['label' => $category['name'], 'url' => '/'.implode("/", $parts).'/'];
		}
		
		if(isset($queryParams['category_id']) && !empty($queryParams['category_id']) && count($queryParams['category_id']) == 1){
			$categories = Category::getCategoryList([
				'fields'    => ['id', 'slug', 'name'],
				'key_field' => 'id',
				'order'     => 'name ASC',
			]);
			$category = '';
			foreach($queryParams['category_id'] as $c_id){
				$category = $categories[$c_id];
			}
			$parts[] = $category['slug'];
			$breadcrumbs[] = ['label' => $category['name'], 'url' => '/'.implode("/", $parts).'/'];
		}
		
		if(isset($queryParams['state']) && !empty($queryParams['state'])){
			if($ajax){
				$state = $queryParams['state'];
				$state_iso = State::getStatesIsoByName($queryParams['state']);
				$parts[] = strtolower($state_iso);
			}else{
				$states = State::getStatesIsoNameList();
				$state_iso = strtoupper($queryParams['state']);
				$state = $states[$state_iso];
				$parts[] = $queryParams['state'];
			}
			$breadcrumbs[] = ['label' => $state, 'url' => '/'.implode("/", $parts).'/'];
		}
		
		if(isset($queryParams['city']) && !empty($queryParams['city'])){
			$city = ucfirst($queryParams['city']);
			$parts[] = strtolower($queryParams['city']);
			if(!empty($state_iso)){
				$city .= ', '.$state_iso;
			}
			$breadcrumbs[] = ['label' => $city, 'url' => '/'.implode("/", $parts).'/'];
		}
		
		return $breadcrumbs;
	}
	
	public function generateCountLabel($count){
		return sprintf(Yii::t('app', 'Found properties: %d'), $count);
	}
	
	public function generateNotFoundLabel($category_ids){
		$str = "We're sorry, there are no %s listings in this area.<br>Please try a nearby city.";
		$category_labels = [];
		
		if(!empty($category_ids)){
			$_categories = Category::getCategoryList([
				'fields' => ['id', 'name'],
				'key_field' => 'id',
				'order' => 'name ASC',
			]);
			foreach($category_ids as $cid){
				$category_labels[$cid] = $_categories[$cid]['name'];
			}
		}
		
		if(!empty($category_labels)){
			$str = sprintf($str, implode(', ', $category_labels));
		}
		
		return $str;
	}
	
	public function getPropertyFeatures($property, $group = true){
		$ret = [];
		#VarDumper::dump($property->Features, 10, 1);
		
		if(!empty($property->Features)){
			if($group){
				foreach($property->Features as $feature){
					$ret[$feature->feature_type_id]['title']   = $feature->feature_type;
					$ret[$feature->feature_type_id]['items'][] = [
						'name'  => $feature->name,
						'image' => $feature->image,
					];
				}
			}else{
				$exclude_features_ids = [];
				
				if(!empty($property->features_sections)){
					foreach($property->features_sections as $features_section){
						foreach($features_section['items'] as $item){
							$exclude_features_ids[] = $item['id'];
						}
					}
				}
				
				foreach($property->Features as $feature){
					if(!in_array($feature->id, $exclude_features_ids))
						$ret[$feature->id] = $feature->name;
				}
			}
		}
		
		return $ret;
	}
	
	public function getPropertyFeaturesBySections($property){
		$ret = [];
		
		if(!empty($property->features)){
			$features = explode(',', $property->features);
			
			if(is_array($features) && !empty($features)){
				$features = PropertyFeatures::find()
	                ->leftJoin('property_features_types', 'property_features_types.id = property_features.feature_type_id')
	                ->where(['IN', 'property_features.id', $features])
					->andWhere(['property_features_types.separated' => 1])
	                ->orderBy(['property_features_types.order' => 'ASC'])
	                ->all();
				
				foreach($features as $feature){
					$features_type = PropertyFeaturesTypes::find()
                          ->select(['section_title', 'section_description'])
                          ->where(['id' => $feature->feature_type_id])
                          ->one();

					$ret[$feature->feature_type_id]['title']   = !is_null($features_type['section_title']) ? $features_type['section_title'] : $feature->feature_type;
					$ret[$feature->feature_type_id]['desc']   = !is_null($features_type['section_description']) ? $features_type['section_description'] : '';
					$ret[$feature->feature_type_id]['items'][] = [
						'id'  => $feature->id,
						'name'  => $feature->name,
						'image' => $feature->image,
					];
				}
			}
		}
		
		#VarDumper::dump($ret, 10, 1);exit;
		
		return $ret;
	}
	
	public function getPropertyNearbyPlaces($property){
		$ret = [];
		
		$nearby_places = NearbyPlaces::find()
			->where(['property_id' => $property->id, 'active' => 1])
			->groupBy(['name', 'address'])
			->orderBy(['type' => 'ASC'])
			->all();
		
		if(!empty($nearby_places)){
			foreach($nearby_places as $nearby_places_model){
				$tmp_arr[] = $nearby_places_model->type;
				$ret[$nearby_places_model->type]['label'] = '';
				$ret[$nearby_places_model->type]['items'][] = [
					'place_id' => $nearby_places_model->place_id,
					'icon_url' => $nearby_places_model->icon_url,
					'name' => $nearby_places_model->name,
					'address' => $nearby_places_model->address,
					'distance' => $nearby_places_model->distance,
					'distance_type' => $nearby_places_model->distance_type,
				];
			}
			
			$nearby_places_types = NearbyPlacesTypes::find()->where(['IN', 'name', $tmp_arr])->all();
			foreach($nearby_places_types as $nearby_places_types_model){
				$ret[$nearby_places_types_model->name]['label'] = $nearby_places_types_model->label;
			}
		}
		
		return $ret;
	}
	
	public function getPropertyCategories($property){
		$ret = [];
		
		$cl = $property->category_link;
		$cat_ids[] = $property->category_id;
		foreach($cl as $c){
			$cat_ids[] = $c->category_id;
		}
		$cat_ids = array_unique($cat_ids);
		
		$categories = Category::find()->where(['IN', 'id', $cat_ids])->all();
		
		if($categories){
			foreach($categories as $category_model){
				$ret[$category_model->id] = [
					'name' => $category_model->name,
					'url' => Url::toRoute(['property/index', 'slug' => $category_model->slug, 'state' => $property->state, 'city' => $property->city]),
				];
			}
		}
		
		return $ret;
	}
	
	/**
	 * NOT USED
	 * @param $property
	 *
	 * @return bool
	 */
	public function getPropertyLiked($property){
		#VarDumper::dump(Yii::$app->user->identity, 10, 1); exit;
		$uid = (Yii::$app->user->identity) ? Yii::$app->user->identity->getId() : 0;
		$sid = Yii::$app->session->id;
		
		if(Yii::$app->user->identity){
			$saved = FavoriteProperties::find()->where(['user_id' => $uid])->orWhere(['sid' => $sid])->andWhere(['property_id' => $property->id])->one();
		}else{
			$saved = FavoriteProperties::find()->where(['sid' => $sid])->andWhere(['property_id' => $property->id])->one();
		}
		return (bool) $saved;
	}
	
	public function getCustomerAddresses($property){
		$session = Yii::$app->session;
		
		$customer_addresses = CustomerAddresses::find()->where(['sid' => $session->getId()])->orderBy(['title' => 'ASC'])->asArray()->all();
		
		if(!empty($customer_addresses)){
			foreach($customer_addresses as $k => $customer_address){
				$customer_addresses[$k]['distance'] = Yii::$app->Helpers->distance($property->address_lat, $property->address_lng, $customer_address['lat'], $customer_address['lng'], 'M');
				$customer_addresses[$k]['distance_type'] = CustomerAddresses::$distance_type;
			}
		}else{
			$customer_addresses[] = [
				'id'            => 0,
				'title'         => '',
				'address'       => '',
				'distance'      => '',
				'distance_type' => '',
				'lat'           => '',
				'lng'           => '',
			];
		}
		
		return $customer_addresses;
	}
	
	public function getCustomerAddressesOLD($property){
		$session = Yii::$app->session;
		
		if(empty($this->customer_all_addresses)){
			$this->customer_all_addresses = CustomerAddresses::find()->where(['sid' => $session->getId()])->groupBy(['title', 'address'])->orderBy(['id' => 'ASC'])->asArray()->all();
		}
		
		$customer_addresses = CustomerAddresses::find()->where(['sid' => $session->getId(), 'property_id' => $property->id])->orderBy(['title' => 'ASC'])->asArray()->all();
		
		#VarDumper::dump($customer_addresses, 10, 1);
		#VarDumper::dump($this->customer_all_addresses, 10, 1);
		#exit;
		
		if(!$customer_addresses && !$this->customer_all_addresses){
			$customer_addresses[] = [
				'id'            => 0,
				'title'         => '',
				'address'       => '',
				'property_id'   => $property->id,
				'distance'      => '',
				'distance_type' => '',
				'lat'           => '',
				'lng'           => '',
			];
		}elseif($this->customer_all_addresses && md5(json_encode($customer_addresses)) != md5(json_encode($this->customer_all_addresses))){
			CustomerAddresses::deleteAll(['sid' => $session->getId(), 'property_id' => $property->id]);
			
			foreach($this->customer_all_addresses as $k => $customer_address){
				$distance = Yii::$app->Helpers->distance($property->address_lat, $property->address_lng, $customer_address['lat'], $customer_address['lng'], 'M');
				
				$customer_address_model = new CustomerAddresses();
				$customer_address_model->sid = $customer_address['sid'];
				$customer_address_model->user_id = $customer_address['user_id'];
				$customer_address_model->property_id = $property['id'];
				$customer_address_model->title = $customer_address['title'];
				$customer_address_model->address = $customer_address['address'];
				$customer_address_model->lat = $customer_address['lat'];
				$customer_address_model->lng = $customer_address['lng'];
				$customer_address_model->distance = $distance;
				$customer_address_model->distance_type = $customer_address['distance_type'];
				$customer_address_model->save(false);
			}
			$customer_addresses = CustomerAddresses::find()->where(['sid' => $session->getId(), 'property_id' => $property->id])->orderBy(['title' => 'ASC'])->asArray()->all();
		}
		
		return $customer_addresses;
	}
	
	private function getNarrowCities($state, $queryParams, $categories){
		#VarDumper::dump($categories, 10, 1);
		#VarDumper::dump($queryParams, 10, 1);
		
		$from_all_cats = false;
		$display_cat_in_url = false;
		
		$inversed_categories = [];
		foreach($categories as $category){
			$inversed_categories[$category['id']] = $category;
		}
		
		$group = $where = [];
		$group[] = 'p.city';
		$where[] = 'p.state = :state';
		if(isset($queryParams['category_ids']) && !empty($queryParams['category_ids'])){
			$display_cat_in_url = true;
			if($from_all_cats){
				$where[] = 'cl.category_id IN ('.implode(',', $queryParams['category_ids']).')';
			}else{
				$cat_id = current($queryParams['category_ids']);
				$where[] = '(p.category_id = '.$cat_id.' OR cl.category_id = '.$cat_id.')';
			}
			#$group[] = 'cl.category_id';
		}
		
		$_sql = "SELECT p.city, p.state, p.category_id
				 FROM properties p
				 LEFT JOIN category_link cl ON cl.property_id = p.id
				 WHERE ".implode(' AND ', $where)."
				 GROUP BY ".implode(', ', $group);
		$properties = Property::findBySql($_sql, [':state' => $state])->limit(10)->asArray()->all();
		
		if(count($properties)){
			foreach($properties as $k => $property){
				$state_iso = State::getStatesIsoByName($property['state']);
				$properties[$k]['city_label'] = $property['city'].', '.$state_iso;
				if($display_cat_in_url){
					$properties[$k]['city_label'] .= ' '.$inversed_categories[$cat_id]['name'];
					$properties[$k]['slug'] = $inversed_categories[$cat_id]['slug'];
				}
				unset($properties[$k]['category_id']);
			}
		}
		#VarDumper::dump($properties, 10, 1);
		
		return $properties;
	}
	
	private function getNearbyCities($queryParams, $categories){
		#VarDumper::dump($categories, 10, 1);
		#VarDumper::dump($queryParams, 10, 1);
		
		$from_all_cats = false;
		$display_cat_in_url = false;
		
		$data = [];
		
		$inversed_categories = [];
		foreach($categories as $category){
			$inversed_categories[$category['id']] = $category;
		}
		
		if(isset($queryParams['category_ids']) && !empty($queryParams['category_ids'])){
			$display_cat_in_url = true;
			if(!$from_all_cats){
				$cat_id = current($queryParams['category_ids']);
			}
		}
		
		if($state = State::getStateByName($queryParams['state'])){
			$city = City::find()
			            ->where(['name' => $queryParams['city'], 'state_id' => $state['id']])
			            ->asArray()
			            ->one();

			if(!empty($city) && !empty($city['nearby_cities'])){
				$cities = City::find()
				              ->where(['IN', 'id', explode(',', $city['nearby_cities'])])
		                      ->andWhere(['state_id' => $state['id']])
		                      ->asArray()
		                      ->all();
				
				if(!empty($cities)){
					foreach($cities as $k => $city){
						$data[$k] = [
							'city' => $city['name'],
							'state' => $state['name'],
							'city_label' => $city['name'].', '.$state['iso_code'],
						];
						if($display_cat_in_url){
							$data[$k]['city_label'] .= ' '.$inversed_categories[$cat_id]['name'];
							$data[$k]['slug'] = $inversed_categories[$cat_id]['slug'];
						}
					}
				}
			}
		}
		
		return $data;
	}
	
	private function getNearbyCitiesOLD(){
		// https://maps.googleapis.com/maps/api/geocode/json?address=Atlanta+GA,+USA&key=AIzaSyAl3D1Rnff8rO5DKIp3YS3w5u2A9F9ZsCA
		// https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=33.7489954,-84.3879824&radius=15000&type=Locality&key=AIzaSyAl3D1Rnff8rO5DKIp3YS3w5u2A9F9ZsCA
		
		/*$du = file_get_contents("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522,151.1957362&radius=500&type=restaurant&key=APIKEY");
		$djd = json_decode(utf8_encode($du), true);
		print_r($djd);*/
		
		
	}
	
}
