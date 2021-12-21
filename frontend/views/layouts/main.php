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
use common\models\User;
use common\models\SiteSettings;
use yii\helpers\Url;
use frontend\widgets\ContactUs;

AppAsset::register($this);

#$session = Yii::$app->session;
#$city = $session->get('city');
#$cityDefault = ($city) ? $city : "jodhpur";

#VarDumper::dump(Yii::$app->params, 10, 1);
$body_class[] = intval(Yii::$app->params['settings']['header_top']) ? 'header-top' : '';
$body_class[] = intval(Yii::$app->params['settings']['header_main']) ? 'header-main' : '';
$body_class = implode(' ', $body_class);
?>
<?php $this->beginPage();?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language;?>" class="<?=$body_class;?>">
	<head>
		<meta charset="<?=Yii::$app->charset;?>">
		<?php if(YII_ENV_DEV):?>
		<meta name="robots" content="noindex,nofollow">
		<?php endif;?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, minimal-ui">
	
		<title><?=Html::encode($this->title);?></title>
		<?php /*<script src="<?=Yii::getAlias('@web')?>/theme/js/page-loader.min.js" async></script>*/?>
		<?php //Html::csrfMetaTags();?>
		<?php $this->registerCsrfMetaTags();?>
		<?php $this->head();?>
	</head>
	<body>
		<?php $this->beginBody();?>
		
		<?=$this->render('header');?>
		
		<?php #Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]);?>
		
		<?=Alert::widget()?>
		
		<?=$content?>
		<!--<main id="site-main" class="site-main"></main>-->
		
		<?=ContactUs::widget();?>
		<?=$this->render('footer');?>

		<?php $this->endBody();?>
	</body>
</html>
<?php $this->endPage();?>
