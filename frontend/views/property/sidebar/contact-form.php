<?php

use yii\bootstrap\ActiveForm;
use common\models\User;

?>
<div class="card">
	<?php $form = ActiveForm::begin(['id' => 'contact-form', 'class' => '']); ?>
	<div class="header">
		<h2>Inquire this Proeprty</h2>
		<small>Call us now or send us your information</small>
	</div>
	<div class="body">
		<a href="tel:<?=User::agentDetail("mobile", $property['user_id'])?>" class="inquire__number">
			<i class="zmdi zmdi-phone"></i>
			+091-<?=User::agentDetail("mobile", $property['user_id'])?>
		</a>
		<input name="ContactForm[reciever]" type="hidden" value="<?=$property['user_id'];?>">
		<input name="ContactForm[title]" type="hidden" value="<?=$property['title'];?>">
		<input name="ContactForm[image]" type="hidden" value="<?=$property['image'];?>">

		<div class="form-group form-group--float required">
			<?=$form->field($contact, 'name', ['options' => ['class' => 'form-group form-group--float'], 'template' => " {input}\n {label} \n <i class='form-group__bar'></i> \n {hint} \n {error}"])->textInput(['options' => ['placeholder' => 'Subject']]);?>
		</div>

		<div class="form-group form-group--float required">
			<?=$form->field($contact, 'email', ['options' => ['class' => 'form-group form-group--float'], 'template' => " {input}\n {label} \n <i class='form-group__bar'></i> \n {hint} \n {error}"])->textInput(['options' => ['placeholder' => 'Subject']]);?>
		</div>


		<div class="form-group form-group--float required">
			<?=$form->field($contact, 'mobile', ['options' => ['class' => 'form-group form-group--float'], 'template' => " {input}\n {label} \n <i class='form-group__bar'></i> \n {hint} \n {error}"])->textInput(['options' => ['placeholder' => 'Subject']]);?>
		</div>

		<div class="form-group form-group--float required">
			<?=$form->field($contact, 'subject', ['options' => ['class' => 'form-group form-group--float'], 'template' => " {input}\n {label} \n <i class='form-group__bar'></i> \n {hint} \n {error}"])->textInput(['options' => ['placeholder' => 'Subject']]);?>
		</div>
		<div class="form-group form-group--float required">
			<?=$form->field($contact, 'body', ['options' => ['class' => 'form-group form-group--float'], 'template' => " {input}\n {label} \n <i class='form-group__bar'></i> \n {hint} \n {error}"])->textarea(['options' => ['placeholder' => 'Hi there, I am interested in '.$property['title']]])->label('Message');?>
		</div>

		<small class="text-muted">By sending us your information, you agree to Roost’s Terms of Use & Privacy Policy.</small>
	</div>
	<div class="footer">
		<button type="submit" class="btn btn-primary">Request Information</button>
		<button class="btn btn-link d-none d-sm-block" data-rmd-action="block-close" data-rmd-target="#inquire">Cancel</button>
	</div>
	<?php ActiveForm::end(); ?>
</div>
