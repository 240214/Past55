<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Settings;
use yii\helpers\VarDumper;

class BaseController extends Controller{

	public function beforeAction($action){
		parent::beforeAction($action);

	    $session = Yii::$app->session;
	    $session->open();
		
	    $settings = Settings::find()
			->select(['setting_name', 'setting_value'])
			->where(['active' => 1])
			->orderBy(['order' => SORT_ASC])
			->asArray()
			->all();
	    #VarDumper::dump($settings, 10, 1);
		
		$_settings = [];
		
		if(!empty($settings)){
	    	foreach($settings as $s){
	    		if($s['setting_name'] == 'smtp_params'){
                    $tmp = [];
	    			$a = explode(PHP_EOL, $s['setting_value']);
	    			foreach($a as $k => $v){
	    				$v = explode(':', $v);
	    				$tmp[$v[0]] = $v[1];
				    }
				    $s['setting_value'] = $tmp;
			    }
			    $_settings[$s['setting_name']] = $s['setting_value'];
		    }
	    }
		
		#VarDumper::dump($_settings, 10, 1);
		
		Yii::$app->params['settings'] = $_settings;
		
	    return true;
	}
}
