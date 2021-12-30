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
			<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
			<div class="col-xs-12">
				<div class="form-group">
					<?=Html::submitButton('Save settings', ['class' => 'btn btn-primary', 'name' => 'site-settings-button']);?>
				</div>
			</div>
			<?php
			foreach($settings as $setting):?>
				<div class="col-lg-6 col-md-10 col-sm-12 col-xs-12">
				<?php switch($setting->field_type):
					case "text":
						echo $form->field($model, $setting->setting_name);
						break;
					case "number":
						echo $form->field($model, $setting->setting_name)->input('number');
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
				endswitch;?>
				</div>
			<?php endforeach;?>
			<div class="col-xs-12">
				<div class="form-group">
					<?=Html::submitButton('Save settings', ['class' => 'btn btn-primary', 'name' => 'site-settings-button']);?>
				</div>
			</div>
			<?php ActiveForm::end(); ?>
	</div>
</div>
