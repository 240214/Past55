<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\ActiveForm;
use yii\helpers\VarDumper;
use common\models\Users;
use yii\helpers\Url;
use frontend\widgets\ContactUs;

AppAsset::register($this);

#VarDumper::dump(YII_ENV_DEV, 10, 1);
$body_class[] = intval(Yii::$app->params['settings']['header_top']) ? 'header-top' : '';
$body_class[] = intval(Yii::$app->params['settings']['header_main']) ? 'header-main' : '';
$body_class = implode(' ', $body_class);
?>
<?php $this->beginPage();?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language;?>" class="<?=$body_class;?>">
	<head>
		<?php if(!YII_ENV_DEV):?>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-NRZJLBC');</script>
		<!-- End Google Tag Manager -->
		<?php endif;?>
		
		<meta charset="<?=Yii::$app->charset;?>">
		<?php if(YII_ENV_DEV):?>
		<meta name="robots" content="noindex,nofollow">
		<?php endif;?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=1, minimal-ui">
		
		<title><?=Html::encode($this->title);?></title>
		<?php /*<script src="<?=Yii::getAlias('@web')?>/theme/js/page-loader.min.js" async></script>*/?>
		<?php $this->registerCsrfMetaTags();?>
		<?php $this->head();?>
	</head>
	<body>
		<?php if(!YII_ENV_DEV):?>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NRZJLBC"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		<?php endif;?>

		<?php $this->beginBody();?>
		
		<?=$this->render('header');?>
		
		<?php #Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]);?>
		
		<?=Alert::widget()?>
		
		<?=$content?>
		
		<?=ContactUs::widget();?>
		<?=$this->render('footer');?>

		<?php $this->endBody();?>
	</body>
</html>
<?php $this->endPage();?>
