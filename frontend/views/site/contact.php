<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
$siteSeting = \common\models\SiteSettings::find()->one();

?>

<section class="section">
    <div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-6">
	            <div class="card d-print-none">
	
	
	                <?php $form = ActiveForm::begin(['id' => 'contact-form','class' => '']); ?>
	
	                <div class="card__header">
	                    <h2><?= $this->title ?>  </h2>
	                    <small> If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.</small>
	                </div>
	                <div class="card__body">
	                    <a href="tel:<?= $siteSeting['mobile'] ?>" class="inquire__number">
	                        <i class="zmdi zmdi-phone"></i>
	                        <?= $siteSeting['mobile'] ?>
	                    </a>
	
	
	
	                    <div class="form-group form-group--float required">
	                        <?= $form->field($model, 'name', ['options'=>['class'=> 'form-group form-group--float'],'template'=>" {input}\n {label} \n <i class='form-group__bar'></i> \n {hint} \n {error}"])->textInput(['options'=>['placeholder'=>'Subject']]); ?>
	                    </div>
	
	                    <div class="form-group form-group--float required">
	                        <?= $form->field($model, 'email', ['options'=>['class'=> 'form-group form-group--float'],'template'=>" {input}\n {label} \n <i class='form-group__bar'></i> \n {hint} \n {error}"])->textInput(['options'=>['placeholder'=>'Subject']]); ?>
	                    </div>
	
	
	                    <div class="form-group form-group--float required">
	                        <?= $form->field($model, 'subject', ['options'=>['class'=> 'form-group form-group--float'],'template'=>" {input}\n {label} \n <i class='form-group__bar'></i> \n {hint} \n {error}"])->textInput(['options'=>['placeholder'=>'Subject']]); ?>
	                    </div>
	                    <div class="form-group form-group--float required">
	                        <?= $form->field($model, 'body', ['options'=>['class'=> 'form-group form-group--float'],'template'=>" {input}\n {label} \n <i class='form-group__bar'></i> \n {hint} \n {error}"])->textarea(['options'=>['placeholder'=>'Hi there, ']])->label('Message'); ?>
	                    </div>
	
	                    <small class="text-muted">By sending us your information, you agree to Roost’s Terms of Use & Privacy Policy.</small>
	                </div>
	
	                <div class="card__footer">
	                    <button type="submit" class="btn btn-primary">Send Email</button>
	                    <button class="btn btn-link d-block d-lg-none d-md-none" data-rmd-action="block-close" data-rmd-target="#inquire">Cancel</button>
	                </div>
	                <?php ActiveForm::end(); ?>
	
	            </div>
	        </div>
	    </div>
    </div>
</section>


