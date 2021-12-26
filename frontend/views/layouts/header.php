<?php

use frontend\models\PasswordResetRequestForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\BootstrapAsset;
use yii\helpers\Url;

#$reset = new PasswordResetRequestForm();
#$this->registerCssFile('@web/theme/css/main.css', ['depends' => [BootstrapAsset::className()]]);

?>
<header id="header" class="container-fluid container-xl site-header">
	<div class="header-home d-flex align-items-center justify-content-between">
		<?php if(intval(Yii::$app->params['settings']['header_top'])):?>
			<?=$this->render('header/top');?>
		<?php endif;?>
		<?php if(intval(Yii::$app->params['settings']['header_main'])):?>
			<?=$this->render('header/main');?>
		<?php endif;?>
	</div>
</header>
