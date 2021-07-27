<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\VarDumper;

#VarDumper::dump($exception->getMessage(), 10, 1);
$this->title = 'Oops! Page not found';
$this->params['breadcrumbs'][] = $this->title;

$message = 'we are sorry, but the page you requested was not found';
$statusCode_arr = str_split($exception->statusCode);
?>
<section id="main__content">
	<div id="error-page" class="main__container">

		<div class="err-container">
			<div class="err-status">
				<h3><?=$this->title;?></h3>
				<h1><span><?=implode('</span><span>', $statusCode_arr);?></span></h1>
			</div>
			<h2><?=nl2br(Html::encode($message));?></h2>
			<hr>
			<a class="btn btn-warning" href="<?=Url::toRoute('/')?>">BACK TO HOME</a>
		</div>

	</div>
</section>
