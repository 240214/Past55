<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $form_model \frontend\models\ContactForm */

use common\models\Settings;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use frontend\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;
use frontend\widgets\PostsCarousel;
use yii\web\View;
use yii\captcha\Captcha;
use frontend\models\ContactForm;
use himiklab\yii2\recaptcha\ReCaptcha3;

$settings = Settings::getSettings();
$form_model = new ContactForm();

$this->registerMetaTag(['name' => 'description', 'content' => $model->meta_description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
if($model->meta_noindex){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title                   = $model->meta_title;
$this->params['breadcrumbs'][] = $model->title;

$this->registerCssFile('@web/theme/css/pages/contact.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);

#VarDumper::dump($settings, 10, 1);
?>
<section class="hero">
	<div class="container first-screen text-center max-w-700">
		<h1 class="main-title mb-15 mb-md-25 me-auto ms-auto"><?=$model->meta_title;?></h1>
	</div>
</section>

<section class="content container-fluid max-w-1290">
	<div class="row">
		<div class="col-12">
			<?=Yii::$app->session->getFlash('error');?>
		</div>
	</div>
	<div class="row flex-sm-row-reverse">
		<div class="col-12 col-sm-6 col-md-5 col-lg-4 mb-3 mb-md-0">
			<div class="max-w-530-sm me-md-auto">
				<div class="card-box">
					<div class="header mb-2">
						<h2 class="title">Contact Info</h2>
					</div>
					<div class="body">
						<ul class="contact-info-items p-0 m-0">
							<?php if(!empty($settings['mobile'])):?>
								<?php $link = str_replace(['(', ')', '-', '+1', ' '], '', $settings['mobile']);?>
								<li>
									<a class="icon-wrapp me-2 text-color-primary" href="tel:+1<?=$link;?>"><i class="bi bi-telephone-fill"></i></a>
									<a class="item" href="tel:+1<?=$link;?>"><?=$settings['mobile'];?></a>
								</li>
							<?php endif;?>
							<?php if(!empty($settings['email'])):?>
								<li>
									<a class="icon-wrapp me-2 text-color-primary" href="mailto:<?=$settings['email'];?>"><i class="bi bi-envelope-fill"></i></a>
									<a class="item" href="mailto:<?=$settings['email'];?>"><?=$settings['email'];?></a>
								</li>
							<?php endif;?>
							<?php if(!empty($settings['facebook'])):?>
								<li>
									<a class="icon-wrapp me-2 text-color-primary" href="<?=$settings['facebook'];?>" target="_blank"><i class="bi bi-facebook"></i></a>
									<a class="item" href="<?=$settings['facebook'];?>" target="_blank">Facebook page</a>
								</li>
							<?php endif;?>
							<?php if(!empty($settings['twiter'])):?>
								<li>
									<a class="icon-wrapp me-2 text-color-primary" href="<?=$settings['twiter'];?>" target="_blank"><i class="bi bi-twitter"></i></a>
									<a class="item" href="<?=$settings['twiter'];?>" target="_blank">Twiter page</a>
								</li>
							<?php endif;?>
							<?php if(!empty($settings['google'])):?>
								<li>
									<a class="icon-wrapp me-2 text-color-primary" href="<?=$settings['google'];?>" target="_blank"><i class="bi bi-google"></i></a>
									<a class="item" href="<?=$settings['google'];?>" target="_blank">Google page</a>
								</li>
							<?php endif;?>
							<?php if(!empty($settings['instagram'])):?>
								<li>
									<a class="icon-wrapp me-2 text-color-primary" href="<?=$settings['instagram'];?>" target="_blank"><i class="bi bi-instagram"></i></a>
									<a class="item" href="<?=$settings['instagram'];?>" target="_blank">Instagram page</a>
								</li>
							<?php endif;?>
							<?php if(!empty($settings['linkedin'])):?>
								<li>
									<a class="icon-wrapp me-2 text-color-primary" href="<?=$settings['linkedin'];?>" target="_blank"><i class="bi bi-linkedin"></i></a>
									<a class="item" href="<?=$settings['linkedin'];?>" target="_blank">LinkedIn page</a>
								</li>
							<?php endif;?>
							<?php if(!empty($settings['address'])):?>
								<li>
									<div class="icon-wrapp me-2 text-color-primary"><i class="bi bi-geo-alt-fill"></i></div>
									<span class="item"><?=$settings['address'];?></span>
								</li>
							<?php endif;?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-7 col-lg-8">
			<?php $form = ActiveForm::begin(['action' => '/contact', 'id' => 'contact-form', 'options' => ['class' => 'max-w-540 m-auto']]); ?>

			<p class="main-text-content text-color-black mb-15 mb-md-25 me-auto ms-auto">If you have business inquiries or other questions, please fill out the following form to contact us.</p>

			<?=$form->field($form_model, 'subject')->hiddenInput(['value' => 'Contact form lead'])->label(false)->hint(false)->error(false);?>
			<?=$form->field($form_model, 'name')->textInput(['class' => 'form-control', 'placeholder' => 'Name'])->label(false);?>
			<?=$form->field($form_model, 'email')->input('email', ['class' => 'form-control', 'placeholder' => 'Email'])->label(false);?>
			<?=$form->field($form_model, 'phone')->input('tel', ['class' => 'form-control', 'placeholder' => 'Phone'])->label(false);?>
			<?=$form->field($form_model, 'message')->textarea(['class' => 'form-control', 'placeholder' => 'Message'])->label(false);?>
			<?=$form->field($form_model, 'reCaptcha')->widget(ReCaptcha3::classname(), ['action' => 'contact'])->label(false);?>

			<p>By sending us your information, you agree to <a href="/terms-and-conditions/">Terms of Use</a> & <a href="/privacy-policy/">Privacy Policy</a>.</p>
		
			<?=Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn primary text-nowrap d-block m-auto me-lg-auto ms-lg-0']);?>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</section>
