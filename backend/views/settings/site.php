<?php

/* @var $this yii\web\View */

/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\Request;
use yii\helpers\VarDumper;
use common\models\form\SettingsForm;

$this->title = 'Site Settings';

$this->params['breadcrumbs'][] = $this->title;

// Yii::setAlias('@front',dirname(dirname(__DIR__)) . '/frontend');

$baseUrl = str_replace('/backend/web', '', (new Request)->getBaseUrl());
Yii::setAlias('@front', $baseUrl.'/frontend/web');
$front = Yii::getAlias('@front');

$option = array(
	'bg_img_1'  => 'background 1',
	'bg_img_2'  => 'background 2',
	'bg_img_3'  => 'background 3',
	'bg_img_4'  => 'background 4',
	'bg_img_5'  => 'background 5',
	'bg_img_6'  => 'background 6',
	'bg_img_7'  => 'background 7',
	'bg_img_8'  => 'background 8',
	'bg_img_9'  => 'background 9',
	'bg_img_10' => 'background 10',
	'bg_img_11' => 'background 11',
	'bg_img_12' => 'background 12',
	'bg_img_13' => 'background 13',
	'bg_img_14' => 'background 14',
	'bg_img_15' => 'background 15'
);
#VarDumper::dump($settings, 10, 1); exit;
#$model = new SettingsForm();
?>
<div class="card">
	<div class="row">
		<div class="col-lg-6 col-md-10 col-sm-12 col-xs-12">
			<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
			<div class="form-group">
				<?=Html::submitButton('Save settings', ['class' => 'btn btn-primary', 'name' => 'site-settings-button']);?>
			</div>
			<?php
			foreach($settings as $setting){
				switch($setting->field_type){
					case "text":
						echo $form->field($model, $setting->setting_name);
						break;
					case "email":
						echo $form->field($model, $setting->setting_name)->input('email');
						break;
					case "tel":
						echo $form->field($model, $setting->setting_name)->input('tel');
						break;
					case "textarea":
						echo $form->field($model, $setting->setting_name)->textarea();
						break;
					case "image":
						echo $form->field($model, $setting->setting_name)->fileInput();
						if(file_exists(Yii::getAlias('@site_images').'/logo/'.$setting->setting_value)){
							echo Html::img($front.'/images/site/logo/'.$setting->setting_value, ['class' => 'img-responsive']);
						}
						break;
					case "select":
						echo $form->field($model, $setting->setting_name)->dropDownList(json_decode($setting->field_options, true));
						break;
				}
			}
			/*
			?>
			<?=$form->field($model, 'site_name')?>
			<?=$form->field($model, 'site_title')?>
			<?=$form->field($model, 'logo')->fileInput();?>
			<div>
				<h5>Current:</h5>
				<div><img src="<?=$front.'/images/site/logo/'.$model->logo?>" style="background-color: #0a6ebd" class="img-responsive"></div>
				<hr>
				<?php //=$form->field($model, 'layout')->radioList($option)->label('home background');?>
				<?=$form->field($model, 'layout')->dropDownList($option)->label("Home Background");?>
				<hr>
			</div>
			<?=$form->field($model, 'meta_keyword')?>
			<?=$form->field($model, 'meta_description')?>
			<?=$form->field($model, 'mobile')?>
			<?=$form->field($model, 'address')->textarea()?>
			<?=$form->field($model, 'disclaimer')->textarea()?>
			<?=$form->field($model, 'email');?>
			<?=$form->field($model, 'facebook');?>
			<?=$form->field($model, 'twiter');?>
			<?=$form->field($model, 'google');?>
			<?php */?>
			<div class="form-group">
				<?=Html::submitButton('Save settings', ['class' => 'btn btn-primary', 'name' => 'site-settings-button']);?>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
