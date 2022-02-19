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

AppAsset::register($this);

$model = new \common\models\Users();
$siteSeting = \common\models\SiteSettings::find()->one();
$blog = \common\models\Posts::find()->select(['blog_title','created_at','id'])->limit(3)->all();
$page = \common\models\Pages::find()->select(['title','id'])->all();


$session = Yii::$app->session;
$city = $session->get('city');
$cityDefault = ($city)?$city:"jodhpur";
$reset = new \frontend\models\PasswordResetRequestForm();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title><?= Html::encode($this->title) ?></title>
    <!-- Material design colors -->
    <link href="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">

    <!-- CSS animations -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/animate.css/animate.min.css">

    <!-- Select2 - Custom Selects -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/select2/dist/css/select2.min.css">

    <!-- Slick Carousel -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/slick-carousel/slick/slick.css">

    <!-- NoUiSlider - Input Slider -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/nouislider/distribute/nouislider.min.css">

    <!-- Light Gallery -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/lightgallery/dist/css/lightgallery.min.css">

    <!-- rateYo - Ratings -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/rateYo/src/jquery.rateyo.css">
    <!-- Site -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/theme/css/basic.css">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/theme/css/app_1.min.css">

    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/theme/css/app_2.min.css">
    <script src="<?= Yii::getAlias('@web') ?>/theme/js/page-loader.min.js" async></script>
    <?php //Html::csrfMetaTags() ?>
    <?php $this->head();?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Start page loader -->
<div id="page-loader">
    <div class="page-loader__spinner"></div>
</div>
<!-- End page loader -->
<header id="header">
    <div class="header__top">
        <div class="container">
            <ul class="top-nav">

                <li class="dropdown <?= (!Yii::$app->user->isGuest)?'':'hidden'; ?>">
                    <a href="#" data-toggle="dropdown">
                        Hi <?= (!Yii::$app->user->isGuest)? Yii::$app->user->identity->username:''; ?>!
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="<?= \yii\helpers\Url::toRoute('my/profile') ?>">Profile</a></li>
                        <li><a href="<?= \yii\helpers\Url::toRoute('dashboard/index') ?>">Dashboard</a></li>
                        <li><a href="<?= \yii\helpers\Url::toRoute('user/update') ?>">profile Settings</a></li>
                        <li><a href="<?= \yii\helpers\Url::toRoute('user/account') ?>">Account Settings</a></li>

                        <li><a href="<?= \yii\helpers\Url::toRoute('my/search') ?>">Saved Searches</a></li>
                        <li><a href="<?= \yii\helpers\Url::toRoute('my/saved/agents') ?>">Saved Agents</a></li>
                        <li><a href="<?= \yii\helpers\Url::toRoute('my/saved/property') ?>">Saved Listings</a></li>
                        <li><a data-method="GET" href="<?= \yii\helpers\Url::toRoute('site/logout') ?>">Logout</a></li>
                    </ul>
                </li>
                <li class="top-nav__icon hidden <?= (!Yii::$app->user->isGuest)?'':'hidden'; ?>">
                    <a href="#">
                        <i class="zmdi zmdi-notifications"></i>
                        <i class="top-nav__alert"></i>
                    </a>
                </li>
                <li class="dropdown top-nav__guest <?= (Yii::$app->user->isGuest)?'':'hidden'; ?>">
                    <a data-toggle="dropdown" href="#">Register</a>
                    <div class="dropdown-menu stop-propagate">
                            <?php $form = ActiveForm::begin(['id' => 'signup-form','action'=>['site/signup']]); ?>
                            <div class="form-group">
                                <input type="email" name="SignupForm[email]"  class="form-control" placeholder="Email Address">
                                <i class="form-group__bar"></i>
                            </div>

                            <div class="form-group">
                                <input type="text" name="SignupForm[username]" class="form-control" placeholder="username">
                                <i class="form-group__bar"></i>
                            </div>

                            <div class="form-group">
                                <input type="password" name="SignupForm[password]" class="form-control" placeholder="Password">
                                <i class="form-group__bar"></i>
                            </div>

                            <p><small>By Signing up with Roost, you're agreeing to our <a href="javascript:void">terms and conditions</a>.</small></p>

                            <button type="reset" class="btn btn-primary btn-block m-t-10 m-b-10">Register not allow in demo</button>

                            <div class="text-center"><small><a href="#">Are you an Agent?</a></small></div>

                            <div class="top-nav__auth hidden">
                                <span>or</span>

                                <div>Sign in using</div>

                                <a href="#" class="mdc-bg-blue-500">
                                    <i class="zmdi zmdi-facebook"></i>
                                </a>

                                <a href="#" class="mdc-bg-cyan-500">
                                    <i class="zmdi zmdi-twitter"></i>
                                </a>

                                <a href="#" class="mdc-bg-red-400">
                                    <i class="zmdi zmdi-google"></i>
                                </a>
                            </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </li>

                <li class="dropdown top-nav__guest <?= (Yii::$app->user->isGuest)?'':'hidden'; ?>">
                    <a data-toggle="dropdown" href="#" data-rmd-action="switch-login">Login</a>

                    <div class="dropdown-menu">
                        <div class="tab-content">
                            <p style="padding: 5px 10px;background-color: #eee;font-size: 10px;">
                                <b>USERNAME:</b> demo &nbsp;&nbsp;|&nbsp;&nbsp; <b>PASSWORD:</b> demo
                            </p>
                            <?php $form = ActiveForm::begin(['options'=>['class'=>'tab-pane fade active in'],'id'=>'top-nav-login','action' => \yii\helpers\Url::toRoute('site/login')]); ?>
                                <div class="form-group">
                                    <input type="text" name="LoginForm[username]" value="demo" class="form-control" placeholder="Username">

                                    <i class="form-group__bar"></i>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="LoginForm[password]" value="demo" class="form-control" placeholder="Password">
                                    <i class="form-group__bar"></i>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block m-t-10 m-b-10">Login</button>

                                <div class="text-center">
                                    <a href="#top-nav-forgot-password" data-toggle="tab"><small>Forgot email/password?</small></a>
                                </div>

                                <div class="top-nav__auth ">
                                    <span>Or</span>

                                    <div>Connect with us on</div>

                                    <a href="//<?= $siteSeting['facebook']; ?>" class="mdc-bg-blue-500">
                                        <i class="zmdi zmdi-facebook"></i>
                                    </a>

                                    <a href="//<?= $siteSeting['twiter'] ?>" class="mdc-bg-cyan-500">
                                        <i class="zmdi zmdi-twitter"></i>
                                    </a>

                                    <a href="//<?= $siteSeting['google'] ?>" class="mdc-bg-red-400">
                                        <i class="zmdi zmdi-google"></i>
                                    </a>
                                </div>
                            <?php ActiveForm::end(); ?>
                            <?php $form = ActiveForm::begin(['id' => 'top-nav-forgot-password','options'=>['class'=>'tab-pane fade forgot-password'],'action'=>['site/request-password-reset']]); ?>

                                <a href="#top-nav-login" class="top-nav__back" data-toggle="tab"></a>

                                <p>Please fill out your email. A link to reset password will be sent there.</p>

                                <div class="form-group">
                                    <?= $form->field($reset, 'email', ['options'=>['class'=> 'form-group form-group--float'],'template'=>" {input}\n {label} \n <i class='form-group__bar'></i> \n {hint} \n {error}"])->textInput(['options'=>['placeholder'=>'Email Address']]); ?>

                                </div>

                                <button class="btn btn-warning btn-block">Reset Password</button>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </li>



                <li class="pull-right top-nav__icon">
                    <a href="//<?= $siteSeting['facebook'] ?>"><i class="zmdi zmdi-facebook"></i></a>
                </li>

                <li class="pull-right top-nav__icon">
                    <a href="//<?= $siteSeting['twiter'] ?>"><i class="zmdi zmdi-twitter"></i></a>
                </li>
                <li class="pull-right top-nav__icon">
                    <a href="//<?= $siteSeting['google'] ?>"><i class="zmdi zmdi-google"></i></a>
                </li>

                <li class="pull-right hidden-xs"><span><i class="zmdi zmdi-email"></i><?= $siteSeting['email'] ?></span></li>
                <li class="pull-right hidden-xs"><span><i class="zmdi zmdi-phone"></i><?= $siteSeting['mobile'] ?></span></li>
            </ul>
        </div>
    </div>
    <div class="header__main">
        <div class="container">
            <a class="logo" href="<?= \yii\helpers\Url::toRoute('/') ?>">
                <img src="<?= Yii::getAlias('@web') ?>/images/site/logo/<?= $siteSeting['logo'] ?>" alt="">
                <div class="logo__text">
                    <span><?= $siteSeting['site_name'] ?></span>
                    <span><?= $siteSeting['site_title'] ?></span>
                </div>
            </a>

            <div class="navigation-trigger visible-xs visible-sm" data-rmd-action="block-open" data-rmd-target=".navigation">
                <i class="zmdi zmdi-menu"></i>
            </div>
	        <?php #VarDumper::dump(Yii::$app->controller->action->id, 10, 1);?>
            <ul class="navigation">
                <li class="visible-xs visible-sm"><a class="navigation__close" data-rmd-action="navigation-close" href="#"><i class="zmdi zmdi-long-arrow-right"></i></a></li>

                <li class="<?= (Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'site/index')?'active':'' ?> navigation__dropdown">
                    <a href="<?= \yii\helpers\Url::toRoute('/') ?>">Home</a>
                </li>
                <li class="<?= (Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'dashboard/index')?'active':'' ?> navigation__dropdown">
                    <a href="<?= \yii\helpers\Url::toRoute('dashboard/index') ?>">Dashboard</a>
                </li>

                <li class="<?= (Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'property/sale')?'active':'' ?> navigation__dropdown">
                    <a href="<?= \yii\helpers\Url::toRoute('property/sale') ?>">Buy</a>
                </li>
                <li class="<?= (Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'property/rent')?'active':'' ?> navigation__dropdown">
                    <a href="<?= \yii\helpers\Url::toRoute('property/rent') ?>">Rent</a>
                </li>
                <li class="<?= (Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'property/basic')?'active':'' ?> navigation__dropdown">
                    <a href="<?= \yii\helpers\Url::toRoute('property/basic') ?>">Submit</a>
                </li>
                <li class="<?= (Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'user/agents')?'active':'' ?> navigation__dropdown">
                    <a href="<?= \yii\helpers\Url::toRoute('user/agents') ?>">Agent</a>
                </li>
                <li class="<?= (Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'blog/index')?'active':'' ?> navigation__dropdown">
                    <a href="<?= \yii\helpers\Url::toRoute('blog/index') ?>">Blogs</a>
                </li>
                <li class="<?= (Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'mortgage/index')?'active':'' ?> navigation__dropdown">
                    <a href="<?= \yii\helpers\Url::toRoute('mortgage/index') ?>">Mortgage</a>
                </li>
                <li class="<?= (Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'site/contact')?'active':'' ?> navigation__dropdown">
                    <a href="<?= \yii\helpers\Url::toRoute('site/contact') ?>">Contact</a>
                </li>

            </ul>
        </div>
    </div>
</header>
    <?php Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
<?= $content ?>

<footer id="footer">
    <div class="container hidden-xs">
        <div class="row">
            <div class="col-sm-4">
                <div class="footer__block">
                    <a class="logo clearfix" href="#">
                        <div class="logo__text">
                            <span><?= $siteSeting['site_name'] ?></span>
                            <span><?= $siteSeting['site_title'] ?></span>
                        </div>
                    </a>

                    <address class="m-t-20 m-b-20 f-14">
                        <?= $siteSeting['address'] ?>
                    </address>

                    <div class="f-20"><?= $siteSeting['mobile'] ?></div>
                    <div class="f-14 m-t-5"><?= $siteSeting['email'] ?></div>

                    <div class="f-20 m-t-20">
                        <a href="//<?= $siteSeting['google'] ?>" class="m-r-10"><i class="zmdi zmdi-google"></i></a>
                        <a href="//<?= $siteSeting['facebook'] ?>" class="m-r-10"><i class="zmdi zmdi-facebook"></i></a>
                        <a href="//<?= $siteSeting['twiter'] ?>"><i class="zmdi zmdi-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="footer__block footer__block--blog">
                    <div class="footer__title">Latest from our blog</div>
                    <?php
                    foreach ($blog as $bl)
                    {
                        $BlogUrl = \yii\helpers\Url::toRoute('blog/detail/'.base64_encode($bl['id']).'/'.str_replace(' ','+',$bl['blog_title']))

                        ?>
                    <a href="<?= $BlogUrl ?>">
                        <?= $bl['blog_title'] ?>
                        <small>On <?= date('Y/m/d',$bl['created_at']) ?> at <?= date('h:i',$bl['created_at']) ?> </small>
                    </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="footer__block">
                    <div class="footer__title">Disclaimer</div>

                    <div><?= $siteSeting['disclaimer'] ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer__bottom">
        <div class="container">
            <span class="footer__copyright">© <?= $siteSeting['site_name'] ?></span>
            <?php
            foreach ($page as $pageList)
            {
                $url = \yii\helpers\Url::toRoute('pages/index/').'/'.base64_encode($pageList['id']).'-'.$pageList['title'];
                echo "<a href='$url'>".$pageList['title']."</a>";
            }
            ?>

        </div>

        <div class="footer__to-top" data-rmd-action="scroll-to" data-rmd-target="html">
            <i class="zmdi zmdi-chevron-up"></i>
        </div>
    </div>
</footer>
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

<!-- Javascript -->
<!-- jQuery -->
<script src="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Waves button ripple effects -->
<script src="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/Waves/dist/waves.min.js"></script>

<!-- Select 2 - Custom Selects -->
<script src="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- Slick Carousel - Custom Alerts -->
<script src="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/slick-carousel/slick/slick.min.js"></script>

<!-- NoUiSlider -->
<script src="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/nouislider/distribute/nouislider.min.js"></script>
<!-- Light Gallery -->
<script src="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/lightgallery/dist/js/lightgallery-all.min.js"></script>

<!-- rateYo - Ratings -->
<script src="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/rateYo/src/jquery.rateyo.js"></script>

<!-- Autosize - Auto height textarea -->
<script src="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/autosize/dist/autosize.min.js"></script>
<!-- jsSocials - Social link sharing -->
<script src="<?= Yii::getAlias('@web') ?>/theme/vendors/bower_components/jssocials/dist/jssocials.min.js"></script>
<!-- IE9 Placeholder -->
<!--[if IE 9 ]>
<script src="<?= Yii::getAlias('@web') ?>/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
<![endif]-->

<!-- Site functions and actions -->

<script src="<?= Yii::getAlias('@web') ?>/theme/js/basic.js"></script>

<script src="<?= Yii::getAlias('@web') ?>/theme/js/app.min.js"></script>

<!-- Demo only -->
<script src="<?= Yii::getAlias('@web') ?>/theme/js/demo/demo.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
