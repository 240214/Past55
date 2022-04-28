<?php

namespace frontend\widgets;

use common\models\Pages;
use Yii;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\VarDumper;

class NavMenu extends Menu{
	
	private $current_url_path = '/';
	
	public function run(){
		$this->current_url_path = trim(Yii::$app->request->pathInfo, '/');
		
		parent::run();
	}
	
	/**
	 * Renders the content of a menu item.
	 * Note that the container and the sub-menus are not rendered here.
	 *
	 * @param array $item the menu item to be rendered. Please refer to [[items]] to see what data might be in the item.
	 *
	 * @return string the rendering result
	 * @throws \Exception
	 */
	protected function renderItem($item){
		if(isset($item['url'])){
			$template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);
			
			return strtr($template, [
				'{url}'   => $item['url'],
				'{label}' => $item['label'],
				'{class}' => $this->isItemActive($item) ? $this->activeCssClass : '',
			]);
		}
		
		$template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);
		
		return strtr($template, [
			'{label}' => $item['label'],
		]);
	}
	
	/**
	 * Checks whether a menu item is active.
	 *
	 * @param array $item the menu item to be checked
	 *
	 * @return bool whether the menu item is active
	 */
	protected function isItemActive($item){
		if(isset($item['url'])){
			$route = Yii::getAlias($item['url']);
			if($route[0] !== '/' && Yii::$app->controller){
				$route = Yii::$app->controller->module->getUniqueId().'/'.$route;
			}
			if(trim($route, '/') !== $this->current_url_path){
				return false;
			}
			
			return true;
		}
		
		return false;
	}
	
}
