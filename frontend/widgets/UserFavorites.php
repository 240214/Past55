<?php

namespace frontend\widgets;

use common\models\FavoriteProperties;
use frontend\assets\AppAsset;
use Yii;
use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\Widget;

class UserFavorites extends Widget{
	
	private $user_favs_count = 0;
	
	public function init(){
		parent::init();
		
		$session = Yii::$app->session;
		$session->open();
		$sid = Yii::$app->session->getId();
		
		$this->user_favs_count = FavoriteProperties::find()->where(['sid' => $sid])->count();
		
		$this->view->registerCssFile('@web/theme/css/widgets/user-favorites.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
	}
	
	public function run(){
		return $this->render('@frontend/views/widgets/user-favorites', [
			'user_favs_count' => $this->user_favs_count == 0 ? '' : $this->user_favs_count,
		]);
	}
	
}
