<?php

/* @var $this yii\web\View */

use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\View;

#VarDumper::dump($exception->getMessage(), 10, 1);
$this->title = 'Oops! Error!';
$this->params['breadcrumbs'][] = $this->title;

$message = $exception->getMessage();
if(empty($message)){
	$message = 'we are sorry, but the page you requested has error';
}
$statusCode_arr = str_split($exception->statusCode);

$this->registerCssFile('@web/theme/css/error.css?v='.YII_CSS_VERS, ['depends' => [BootstrapAsset::className()]]);
?>
<section id="main__content" class="first-screen">
	<div id="error-page" class="container">

		<div class="row justify-content-between align-items-center content">
			<div class="col-12 text-center">
				<h3 class="ff-pt-serif"><?=$this->title;?></h3>
				<h1 class="first-screen-title"><span><?=implode('</span><span>', $statusCode_arr);?></span></h1>
				<p class="main-text-content"><?=nl2br(Html::encode($message));?></p>
				<a class="btn-primary-medium m-auto" href="<?=Url::toRoute('/')?>">Back To Home</a>
			</div>
		</div>

	</div>
</section>
