<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $form_model \frontend\models\ContactForm */

use common\models\Settings;
use yii\bootstrap\ActiveForm;
use yii\helpers\VarDumper;
use frontend\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;
use frontend\widgets\PostsCarousel;
use yii\web\View;
use yii\captcha\Captcha;
use frontend\models\ContactForm;

$siteSeting = Settings::getSettings();
$form_model = new ContactForm();

$this->registerMetaTag(['name' => 'description', 'content' => $model->meta_description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
if($model->meta_noindex){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title                   = $model->meta_title;
$this->params['breadcrumbs'][] = $model->title;

$this->registerCssFile('@web/theme/css/pages/contact.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);

?>
<section class="hero">
	<div class="container first-screen text-center max-w-700">
		<h1 class="main-title mb-15 mb-md-25 me-auto ms-auto"><?=$model->meta_title;?></h1>
		<p class="main-text-content text-color-black mb-15 mb-md-25 me-auto ms-auto">If you have business inquiries or other questions, please fill out the following form to contact us.</p>
	</div>
</section>

<section class="content container-fluid max-w-1290">
	<div class="row flex-md-row-reverse">
		<div class="col-12 col-md-6 mb-3 mb-md-0">
			<div class="max-w-530-sm me-md-auto">
				<h2 class="item-title mb-15 mb-md-2">Make a difference</h2>
				<p class="item-text mb-2 mb-md-3">Contribute work that has a direct impact on the quality of peoples lives. GeorgiaCaring.com is committed to helping our senior citizens.</p>
				<h2 class="item-title mb-15 mb-md-2">Flexible hours</h2>
				<p class="item-text mb-2 mb-md-3">With remote employees from all corners of the world, choose a schedule that best fits your life.</p>
				<h2 class="item-title mb-15 mb-md-2">Work From Home</h2>
				<p class="item-text mb-0">As a fully remote company, we have embraced the new way of doing business. Join us from anywhere in the world.</p>
			</div>
		</div>
		<div class="col-12 col-md-6 work-proccess">
			<?php $form = ActiveForm::begin(['id' => 'contact-form', 'class' => '']); ?>

			<div class="card__body">
				<a href="tel:<?=$siteSeting['mobile']?>" class="inquire__number">
					<i class="zmdi zmdi-phone"></i>
					<?=$siteSeting['mobile']?>
				</a>


				<div class="form-group form-group--float required">
					<?=$form->field($form_model, 'name', ['options' => ['class' => 'form-group form-group--float']])->textInput(['options' => ['placeholder' => 'Subject']]);?>
				</div>

				<div class="form-group form-group--float required">
					<?=$form->field($form_model, 'email', ['options' => ['class' => 'form-group form-group--float']])->textInput(['options' => ['placeholder' => 'Subject']]);?>
				</div>

				<div class="form-group form-group--float required">
					<?=$form->field($form_model, 'phone', ['options' => ['class' => 'form-group form-group--float']])->textInput(['options' => ['placeholder' => 'Subject']]);?>
				</div>

				<div class="form-group form-group--float required">
					<?=$form->field($form_model, 'body', ['options' => ['class' => 'form-group form-group--float']])->textarea(['options' => ['placeholder' => 'Hi there, ']])->label('Message');?>
				</div>

				<small class="text-muted">By sending us your information, you agree to Roost’s Terms of Use & Privacy Policy.</small>
			</div>

			<div class="card__footer">
				<button type="submit" class="btn btn-primary">Send</button>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</section>
