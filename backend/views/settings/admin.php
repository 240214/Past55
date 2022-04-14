<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$email       = \Yii::$app->user->identity->email;
$username    = \Yii::$app->user->identity->username;
$this->title = 'Admin Settings';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
	<div class="row">
		<div class="col-lg-3">
			<div class="panel panel-piluku">
				<div class="panel-body">
					<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
					<?=$form->field($model, 'username')->textInput(['value' => $username])?>
					<?=$form->field($model, 'email')->textInput(['value' => $email])?>
					<?=$form->field($model, 'password')->passwordInput()?>
					<?=Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'admin-settings-button'])?>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
		
		</div>
	</div>
</div>
