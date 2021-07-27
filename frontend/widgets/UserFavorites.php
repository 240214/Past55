<?php

namespace frontend\widgets;

use common\models\FavoriteProperties;
use Yii;
use yii\bootstrap\Widget;

class UserFavorites extends Widget{
	
	private $user_favs_count = 0;
	
	public function init(){
		parent::init();
		
		$session = Yii::$app->session;
		$session->open();
		$sid = Yii::$app->session->getId();
		
		$this->user_favs_count = FavoriteProperties::find()->where(['sid' => $sid])->count();
	}
	
	public function run(){
		return $this->render('@frontend/views/widgets/user-favorites', [
			'user_favs_count' => $this->user_favs_count,
		]);
	}
	
}
