<?php
use dosamigos\tinymce\TinyMce;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

#VarDumper::dump($model->office_hours, 10, 1); exit;
if(!empty($model->office_hours)){
	if(is_array($model->office_hours)){
		$office_hours = $model->office_hours_types;
	}else{
		$office_hours = Json::decode($model->office_hours, true);
	}
}else{
	$office_hours = $model->office_hours_types;
}

$checkbox_template_1 = '
<label for="property-display_contact_widget" class="switch-label left">'.$model->getAttributeLabel('display_contact_widget').'</label>
<label class="switch">{input}<span class="slider round"></span></label>
{label}{error}{hint}';

$checkbox_template_2 = '
<label for="property-display_office_hours_widget" class="switch-label left">'.$model->getAttributeLabel('display_office_hours_widget').'</label>
<label class="switch">{input}<span class="slider round"></span></label>
{label}{error}{hint}';
?>
<div class="row">
	<div class="col-md-4">
		<?=$form->field($model, 'display_contact_widget', ['template' => $checkbox_template_1])->checkbox(['label' => false]);?>
		<?=$form->field($model, 'contact_widget_title');?>
		<?=$form->field($model, 'contact_phone');?>
		<?=$form->field($model, 'contact_email');?>
		<?=$form->field($model, 'contact_website');?>
		<?=$form->field($model, 'contact_address');?>
		<?=$form->field($model, 'contacts')->widget(TinyMce::className(), Yii::$app->params['tinymce']);?>
	</div>
	<div class="col-md-4">
		<?=$form->field($model, 'display_office_hours_widget', ['template' => $checkbox_template_2])->checkbox(['label' => false]);?>
		<div id="office_hours_container" class="office-hours-container">
			<label class="control-label">Office hours</label>
			<table class="table w-auto table-striped table-bordered">
				<thead>
					<tr>
						<th class="text-center">Day</th>
						<th class="text-center">From</th>
						<th class="text-center">To</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($office_hours as $day => $item):?>
					<tr>
						<td><?=$day;?></td>
						<td><?=Html::textInput('Property[office_hours]['.$day.'][from]', $item['from'], ['class' => 'form-control']);?></td>
						<td><?=Html::textInput('Property[office_hours]['.$day.'][to]', $item['to'], ['class' => 'form-control']);?></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>
</div>
