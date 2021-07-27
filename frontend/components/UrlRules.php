<?php

namespace frontend\components;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\UrlRuleInterface;
use yii\helpers\VarDumper;
use yii\base\BaseObject;
use common\models\Property;
use common\models\Category;
use common\models\State;
use common\models\City;
use yii\web\UrlRule;
use yii\web\UrlManager;

class UrlRules implements UrlRuleInterface{
	
	public $normalizer = false;
	private $objcet_type = null;
	private $objcet_id = 0;
	private $states = [];
	private $params = [];
	
	public function createUrl($manager, $route, $params){
		
		#VarDumper::dump($params, 10, 1);
		
		if(strstr($route, 'page-<page:\d+>') !== false){
			$pageNum = (isset($params['page']) && !empty($params['page'])) ? 'page-'.$params['page'] : '';
			$route = str_replace('page-<page:\d+>', $pageNum, $route);
		}
		
		if($route === 'property/view' || $route === 'property/index'){
			#VarDumper::dump($params, 10, 1);
			
			$url_a = [];
			
			if(isset($params['state'])){
				$url_a[] = $this->getStateSlug($params['state']);
			}

			if(isset($params['city'])){
				$url_a[] = strtolower(str_replace(' ', '-', $params['city']));
			}
			
			if(isset($params['slug']) && !empty($params['slug'])){
				$url_a[] = $params['slug'];
			}elseif(isset($params['id']) && !empty($params['id'])){
				$url_a = array_filter($url_a);
				if(empty($url_a)){
					$url_a[] = $route;
				}
				$url_a[] = $params['id'];
			}
			$url_a = array_filter($url_a);
			
			
			return implode('/', $url_a).'/';
		}
		
		if($route === 'page/view'){
			if(isset($params['slug'])){
				$url_a[] = $params['slug'];

				$url_a = array_filter($url_a);
				
				return implode('/', $url_a).'/';
			}
		}
		
		return $route;
	}
	
	/**
	 * Parse request
	 *
	 * @param \yii\web\Request|UrlManager $manager
	 * @param \yii\web\Request $request
	 *
	 * @return array|boolean
	 */
	public function parseRequest($manager, $request){

		$pathInfo = $request->getPathInfo();
		$pathInfo = trim($pathInfo, '/');
		$request_fragments = array_filter(explode('/', $pathInfo));
		$last_fragment = end($request_fragments);
		
		#VarDumper::dump($request_fragments, 10, 1); exit;
		
		if(empty($request_fragments))
			return false;
		
		/** Page rules **/
		
		switch($last_fragment){
			case "about-us":
			case "privacy-policy":
			case "term-of-use":
				return ['pages/view', ['slug' => $last_fragment]];
				break;
		}
		
		
		/** Property rules **/
		
		if($pathInfo == 'property/filter'){
			return ['property/filter', []];
		}
		
		if(preg_match('/page-(\d+)/', $pathInfo, $match)){
			#VarDumper::dump($match, 10, 1); exit;
			$request_fragments_f = array_flip($request_fragments);
			$key = $request_fragments_f[$match[0]];
			$page_num = isset($match[1]) ? $match[1] : 1;
			$this->setParam('page', $page_num);

			$request_fragments = array_slice($request_fragments, 0, $key);
		}
		
		$last_fragment = end($request_fragments);
		if(strstr($last_fragment, '-and-') !== false){
			$this->setParam('categories', $last_fragment);
			$request_fragments = array_slice($request_fragments, 0, -1);
		}
		
		$this->setParams($request_fragments);

		#VarDumper::dump($request_fragments, 10, 1); exit;
		#VarDumper::dump($pathInfo, 10, 1); exit;
		#VarDumper::dump($this->params, 10, 1); exit;
		#VarDumper::dump($this->objcet_type, 10, 1); exit;
		
		switch($this->objcet_type){
			case "property":
				$this->setParam('id', $this->objcet_id);
				return ['property/view', $this->params];
				break;
			case "state":
			case "city":
			case "category":
				return ['property/index', $this->params];
				break;
		}
		
		return false;
	}
	
	private function getStateSlug($state){
		if(empty($this->states)){
			$statesModel = State::find()->all();
			$this->states = ArrayHelper::map($statesModel, 'name', 'iso_code');
		}
		
		return isset($this->states[$state]) ? strtolower($this->states[$state]) : '';
	}
	
	private function is_property($arg){
		if(is_numeric($arg) > 0){
			$model = Property::find()->where(['id' => $arg])->one();
		}else{
			$model = Property::find()->where(['slug' => $arg])->one();
		}
		
		return (!is_null($model)) ? $model->id : false;
	}
	
	private function is_category($arg){
		if(is_numeric($arg) > 0){
			$model = Category::find()->where(['id' => $arg])->one();
		}else{
			$model = Category::find()->where(['slug' => $arg])->one();
		}
		
		return (!is_null($model)) ? $model->id : false;
	}
	
	private function is_city($arg){
		if(is_numeric($arg) > 0){
			$model = City::find()->where(['id' => $arg])->one();
		}else{
			$model = City::find()
			             ->where(['name' => ucfirst($arg)])
			             ->orWhere(['name' => str_replace('-', ' ', $arg)])
			             ->one();
		}
		
		return (!is_null($model)) ? $model->id : false;
	}
	
	private function is_state($arg){
		if(is_numeric($arg) > 0){
			$model = State::find()->where(['id' => $arg])->one();
		}else{
			$model = State::find()->where(['iso_code' => $arg])->one();
		}
		
		return (!is_null($model)) ? $model->id : false;
	}
	
	private function getObjectType($last_fragment){
		$objcet_type = null;
		$id = 0;
		
		if($objcet_type == null && $id = $this->is_property($last_fragment)){
			$objcet_type = 'property';
		}
		
		if($objcet_type == null && $id = $this->is_category($last_fragment)){
			$objcet_type = 'category';
		}
		
		if($objcet_type == null && $id = $this->is_city($last_fragment)){
			$objcet_type = 'city';
		}
		
		if($objcet_type == null && $id = $this->is_state($last_fragment)){
			$objcet_type = 'state';
		}
		
		$this->objcet_id = $id; # <- used only property object_type
		$this->objcet_type = $objcet_type;
		
		return $objcet_type;
	}
	
	private function setParams($request_fragments){
		foreach($request_fragments as $fragment){
			$objcet_type = $this->getObjectType($fragment);
			if($objcet_type != null){
				$this->setParam($objcet_type, $fragment);
			}
		}
	}
	
	private function setParam($key, $value){
		$this->params[$key] = $value;
	}
	
}
