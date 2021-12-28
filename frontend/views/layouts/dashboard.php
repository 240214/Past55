<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\DashboardAsset;
use common\widgets\Alert;
use yii\bootstrap\ActiveForm;
DashboardAsset::register($this);

$model = new \common\models\User();
$uid = Yii::$app->user->identity->getId();

$leads = \common\models\Leads::find()->where(['reciever'=>$uid])->limit(5)->orderBy(['id'=>SORT_ASC])->all();;
$siteSeting = \common\models\SiteSettings::find()->one();

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title><?= Html::encode($this->title) ?></title>

    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/theme/css/app_1.min.css">

    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/theme/css/app_2.min.css">
    <script src="<?= Yii::getAlias('@web') ?>/theme/js/page-loader.min.js" async></script>
    <?php //Html::csrfMetaTags() ?>
    <?php // $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Start page loader -->
<div id="page-loader">
    <div class="page-loader__spinner"></div>
</div>
<!-- End page loader -->

<header id="header-alt">
    <a href="#" class="header-alt__trigger hidden-lg" data-rmd-action="block-open" data-rmd-target="#main__sidebar">
        <i class="zmdi zmdi-menu"></i>
    </a>

    <a href="<?= \yii\helpers\Url::toRoute('dashboard/index') ?>" class="header-alt__logo hidden-xs"><?= Yii::$app->user->identity->username ?> Dashboard</a>

    <ul class="header-alt__menu">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown"><i class="zmdi zmdi-email"></i></a>

            <div class="dropdown-menu dropdown-menu--lg pull-right">
                <div class="list-group">
                    <div class="list-group__header">
                        MESSAGES / LEADS
                    </div>
                    <?php

                    foreach ($leads as $list)
                    {
                        $status =  $list['status'];
                        switch ($status) {
                            case "pending":
                                $status = "Not Connected";
                                $class = "orange";
                                $icon = "zmdi-minus-circle-outline ";

                                break;
                            case "connected":
                                $status = "Connected";
                                $class = "green";
                                $icon = "zmdi-check-all";

                                break;

                            case "cancelled":
                                $status = "Cancelled";
                                $class = "red";
                                $icon = "zmdi-close-circle";

                                break;

                        }


                        ?>
                        <a class="list-group-item media" href="#">
                            <div class="pull-left">
                                <img class="list-group__img img-circle" width="40" height="40" src="<?= Yii::getAlias('@web') ?>/images/property/cover/<?= $list['image']; ?>" alt="">
                            </div>
                            <div class="media-body list-group__text">
                                <strong><?= $list['sender']; ?> :  <span class="mdc-bg-<?= $class; ?>-400"><i class="zmdi <?= $icon; ?> hidden-xs"></i> <?= $status; ?></span></strong>
                                <small><?= $list['title']; ?></small>
                            </div>
                        </a>

                        <?php
                    }
                    ?>


                    <a class="view-more" href="<?= \yii\helpers\Url::toRoute('leads/index') ?>">View all</a>
                </div>
            </div>
        </li>
        <li class="hidden-xs">
            <a href="<?= \yii\helpers\Url::toRoute('site/index') ?>"><i class="zmdi zmdi-home"></i></a>
        </li>
        <li class="header-alt__profile dropdown">
            <a href="#" data-toggle="dropdown">
                <img src="<?= Yii::getAlias('@web') ?>/images/user/<?= Yii::$app->user->identity->image ?>" alt="">
            </a>
            <ul class="dropdown-menu  pull-right">
                <li><a href="<?= \yii\helpers\Url::toRoute('my/profile') ?>">Profile</a></li>
                <li><a href="<?= \yii\helpers\Url::toRoute('dashboard/index') ?>">Dashboard</a></li>
                <li><a href="<?= \yii\helpers\Url::toRoute('user/update') ?>">profile Settings</a></li>
                <li><a href="<?= \yii\helpers\Url::toRoute('user/account') ?>">Account Settings</a></li>

            </ul>
        </li>
    </ul>


</header>

<main id="main">
    <aside id="main__sidebar">
        <a class="hidden-lg main__block-close" href="#" data-rmd-action="block-close" data-rmd-target="#main__sidebar">
            <i class="zmdi zmdi-long-arrow-left"></i>
        </a>

        <ul class="main-menu">
            <li><a target="_blank" href="<?= \yii\helpers\Url::toRoute('site/index') ?>"><i class="zmdi zmdi-home"></i> Home</a></li>
            <li class="<?= (Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'dashboard/index')?'active':'' ?>"><a href="<?= \yii\helpers\Url::toRoute('dashboard/index') ?>"><i class="zmdi zmdi-chart"></i> Analytics</a></li>
            <li class="<?= (Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'dashboard/listing')?'active':'' ?>"><a href="<?= \yii\helpers\Url::toRoute('dashboard/listing') ?>"><i class="zmdi zmdi-view-list"></i> Listings</a></li>
            <li class="<?= (Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'dashboard/blog')?'active':'' ?>"><a href="<?= \yii\helpers\Url::toRoute('dashboard/blog') ?>"><i class="zmdi zmdi-blogger"></i>My Blog</a></li>

            <li class="<?= (Yii::$app->controller->id == 'leads')?'active':'' ?>"><a href="<?= \yii\helpers\Url::toRoute('leads/index') ?>"><i class="zmdi zmdi-assignment "></i> Leads</a></li>
            <li class="<?= (Yii::$app->controller->id == 'tasks')?'active':'' ?>"><a href="<?= \yii\helpers\Url::toRoute('tasks/index') ?>"><i class="zmdi zmdi-check-circle"></i> Tasks Lists</a></li>
            <li class="<?= (Yii::$app->controller->id == 'contacts')?'active':'' ?>"><a href="<?= \yii\helpers\Url::toRoute('contacts/index') ?>"><i class="zmdi zmdi-account-box"></i> Contacts</a></li>
            <li class="<?= (Yii::$app->controller->id == 'groups')?'active':'' ?>"><a href="<?= \yii\helpers\Url::toRoute('groups/index') ?>"><i class="zmdi zmdi-group"></i> Groups</a></li>
            <li class="<?= (Yii::$app->controller->id == 'notes')?'active':'' ?>"><a href="<?= \yii\helpers\Url::toRoute('notes/index') ?>"><i class="zmdi zmdi-file-text"></i> Notes</a></li>
            <li class="<?= (Yii::$app->controller->id == 'activity')?'active':'' ?>"><a data-method="GET" href="<?= \yii\helpers\Url::toRoute('site/logout') ?>"><i class="zmdi zmdi-power-off"></i>LogOut</a></li>
        </ul>
    </aside>
    <?php Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>

    <footer id="footer-alt">
        Copyright © <?= date('Y',time()) ?> <?= $siteSeting['site_name'] ?>

        <ul class="footer-alt__menu">
            <li><a href="<?= \yii\helpers\Url::toRoute('site/index') ?>">Home</a></li>
            <li><a href="<?= \yii\helpers\Url::toRoute('dashboard/index') ?>">Dashboard</a></li>
            <li><a href="<?= \yii\helpers\Url::toRoute('site/contact') ?>">Contact</a></li>
        </ul>
    </footer>
</main>


<!-- Javascript -->

<!-- jQuery -->
<script src="<?= Yii::getAlias('@web') ?>/theme/plugins/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="<?= Yii::getAlias('@web') ?>/theme/plugins/bootstrap3/dist/js/bootstrap.min.js"></script>

<!-- Waves button ripple effects -->
<script src="<?= Yii::getAlias('@web') ?>/theme/plugins/Waves/dist/waves.min.js"></script>




<!-- Autosize - Auto height textarea -->
<script src="<?= Yii::getAlias('@web') ?>/theme/plugins/autosize/dist/autosize.min.js"></script>
<!-- ClampJs - Clamp lines -->
<script src="<?= Yii::getAlias('@web') ?>/theme/plugins/Clamp.js/clamp.min.js"></script>
<!-- Trumbowg - WYSIWYG Editor-->
<script src="<?= Yii::getAlias('@web') ?>/theme/plugins/trumbowyg/dist/trumbowyg.min.js"></script>
<!-- IE9 Placeholder -->
<!--[if IE 9 ]>
<script src="<?= Yii::getAlias('@web') ?>/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<![endif]-->

<!-- Site functions and actions -->
<script src="<?= Yii::getAlias('@web') ?>/theme/js/basic.js"></script>

<script src="<?= Yii::getAlias('@web') ?>/theme/js/app.min.js"></script>

<!-- Demo only -->
<script src="<?= Yii::getAlias('@web') ?>/theme/js/demo/demo.js"></script>

<script src="<?= Yii::getAlias('@web') ?>/theme/js/demo/charts/line-chart.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/theme/js/demo/charts/pie-chart.js"></script>

<script src="<?= Yii::getAlias('@web') ?>/theme/plugins/Flot/jquery.flot.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/theme/plugins/Flot/jquery.flot.pie.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/theme/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/theme/plugins/Flot/jquery.flot.resize.js"></script>

<?php $this->endBody() ?>
<!-- ECharts -->
<script src="<?= Yii::getAlias('@web') ?>/theme/js/echarts/dist/echarts.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/theme/js/echarts/map/js/world.js"></script>

</body>

</html>
<?php $this->endPage() ?>
