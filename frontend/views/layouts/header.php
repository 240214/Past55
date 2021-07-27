<?php

use frontend\models\PasswordResetRequestForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$reset = new PasswordResetRequestForm();

?>
<header id="header" class="site-header bg-purple">
	<?php if(intval(Yii::$app->params['settings']['header_top'])):?>
		<?=$this->render('partials/header-top');?>
	<?php endif;?>
	<?php if(intval(Yii::$app->params['settings']['header_main'])):?>
		<?=$this->render('partials/header-main');?>
	<?php endif;?>
</header>
