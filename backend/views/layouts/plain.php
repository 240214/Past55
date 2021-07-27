<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template/bootstrap/css/bootstrap.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template/ionicons/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template/dist/css/Myadmin.css">

    <!-- quikr Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php //$this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper  bg-gray-light">


     <div class="container  bg-white">
         <div class="row">
             <div class="col-lg-4 col-lg-offset-4" style="color: #777">
                 <?= $content ?>
             </div>
         </div>
     </div>

</div><!-- ./wrapper -->
<?php $this->endBody() ?>
<!-- jQuery 2.1.4 -->
<script src="<?= Yii::getAlias('@web') ?>/template/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?= Yii::getAlias('@web') ?>/template/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?= Yii::getAlias('@web') ?>/template/plugins/fastclick/fastclick.min.js"></script>
<!-- Myadmin App -->
<script src="<?= Yii::getAlias('@web') ?>/template/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="<?= Yii::getAlias('@web') ?>/template/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= Yii::getAlias('@web') ?>/template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?= Yii::getAlias('@web') ?>/template/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?= Yii::getAlias('@web') ?>/template/plugins/chartjs/Chart.min.js"></script>
<!-- Myadmin dashboard demo (This is only for demo purposes) -->
<script src="<?= Yii::getAlias('@web') ?>/template/dist/js/pages/dashboard2.js"></script>
<!-- Myadmin for demo purposes -->
<script src="<?= Yii::getAlias('@web') ?>/template/dist/js/demo.js"></script>


</body>

</html>
<?php $this->endPage() ?>
