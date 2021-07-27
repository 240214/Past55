<?php

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Json;

$js_options = [
	'api_key' => Yii::$app->params['google_api_key'],
	'language' => 'en_US',
];
?>
<head>
	<meta charset="<?=Yii::$app->charset;?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?=Html::csrfMetaTags();?>
	<title><?=Html::encode($this->title);?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<?php $this->registerJs("var globals = ".Json::htmlEncode($js_options).";", View::POS_HEAD, 'globals');?>
	<?php $this->head();?>
</head>
