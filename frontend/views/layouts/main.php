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
		
		<main id="site-main" class="site-main">
			<?=$content?>
		</main>
		
		<?=$this->render('footer');?>

		<div id="js_loader" class="loader trans_me"><div class="page-loader__spinner"></div></div>
		<div id="js_backdrop" data-trigger="js_action_click" data-action="" data-target="" class="rmd-backdrop rmd-backdrop--dark"></div>
		
		<!-- Older IE warning message -->
		<!--[if lt IE 9]>
		<div class="ie-warning">
			<h1>Warning!!</h1>
			<p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
			<div class="ie-warning__inner">
				<ul class="ie-warning__download">
					<li>
						<a href="http://www.google.com/chrome/">
							<img src="img/browsers/chrome.png" alt="">
							<div>Chrome</div>
						</a>
					</li>
					<li>
						<a href="https://www.mozilla.org/en-US/firefox/new/">
							<img src="img/browsers/firefox.png" alt="">
							<div>Firefox</div>
						</a>
					</li>
					<li>
						<a href="http://www.opera.com">
							<img src="img/browsers/opera.png" alt="">
							<div>Opera</div>
						</a>
					</li>
					<li>
						<a href="https://www.apple.com/safari/">
							<img src="img/browsers/safari.png" alt="">
							<div>Safari</div>
						</a>
					</li>
					<li>
						<a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
							<img src="img/browsers/ie.png" alt="">
							<div>IE (New)</div>
						</a>
					</li>
				</ul>
			</div>
			<p>Sorry for the inconvenience!</p>
		</div>
		<![endif]-->
		<!-- IE9 Placeholder -->
		<!--[if IE 9 ]>
		<script src="<?= Yii::getAlias('@web') ?>/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
		<![endif]-->
		<?php $this->endBody();?>
	</body>
</html>
<?php $this->endPage();?>
