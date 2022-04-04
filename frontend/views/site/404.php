<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\bootstrap\BootstrapAsset;

$this->title = 'Oops! Page not found';
$this->params['breadcrumbs'][] = $this->title;

$message = 'we are sorry, but the page you requested was not found';
$statusCode_arr = str_split($exception->statusCode);

$this->registerCssFile('@web/theme/css/404.css', ['depends' => [BootstrapAsset::className()]]);

#VarDumper::dump($statusCode_arr, 10, 1);
?>
<section id="main__content" class="first-screen">
	<div id="error-page" class="container">

		<div class="row justify-content-between align-items-center content">
			<div class="col-12 text-center">
				<h3><?=$this->title;?></h3>
				<h1 class="first-screen-title"><span><?=implode('</span><span>', $statusCode_arr);?></span></h1>
				<p class="main-text-content"><?=nl2br(Html::encode($message));?></p>
				<a class="btn btn-warning" href="<?=Url::toRoute('/')?>">BACK TO HOME</a>
			</div>
		</div>

	</div>
</section>
