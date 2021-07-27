<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $model common\models\Property */
/* @var $form yii\widgets\ActiveForm */


$pluginOptions = [
	'browseOnZoneClick' => true,
	'showCaption' => false,
	'showRemove' => false,
	'showUpload' => false,
	'showBrowse' => false,
	'showCancel' => false,
];

$selected_features = !empty($model->features) ? explode(',', $model->features) : [];

$tabs = [
	'main' => ['title' => 'Main', 'view' => 'tabs/main.php'],
	'locations' => ['title' => 'location', 'view' => 'tabs/locations.php'],
	'features' => ['title' => 'Features', 'view' => 'tabs/features.php', 'options' => ['selected_features' => $selected_features]],
	'contacts' => ['title' => 'Contacts', 'view' => 'tabs/contacts.php'],
	'description' => ['title' => 'Overview', 'view' => 'tabs/description.php'],
	'pet_policy' => ['title' => 'Pet policy', 'view' => 'tabs/pet-policy.php'],
	'image' => ['title' => 'Image', 'view' => 'tabs/image.php', 'options' => ['pluginOptions' => $pluginOptions]],
	'gallery' => ['title' => 'Gallery', 'view' => 'tabs/gallery.php', 'options' => ['pluginOptions' => $pluginOptions]],
];

$active_tab = 'main';

foreach($tabs as $tab_name => $tab){
	$tabs[$tab_name]['active'] = '';
	if($tab_name == $active_tab){
		$tabs[$tab_name]['active'] = 'active';
	}
	if(!isset($tabs[$tab_name]['options'])){
		$tabs[$tab_name]['options'] = [];
	}
}
?>

<div class="property-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'pr']]);?>
		<div id="js_data_loader" class="js_data_loader bg-loader"></div>
	
		<ul class="nav nav-tabs" role="tablist">
			<?php foreach($tabs as $tab_name => $tab):?>
			<li role="presentation" class="<?=$tab['active'];?>">
				<a href="#<?=$tab_name;?>" aria-controls="<?=$tab_name;?>" role="tab" data-toggle="tab"><?=$tab['title'];?></a>
			</li>
			<?php endforeach;?>
		</ul>
		
		<div class="tab-content">
			<?php foreach($tabs as $tab_name => $tab):?>
			<div role="tabpanel" class="tab-pane <?=$tab['active'];?>" id="<?=$tab_name;?>">
				<?php if(!empty($tab['view'])):?>
					<?=$this->render($tab['view'], array_merge(['form' => $form, 'model' => $model], $tab['options']));?>
				<?php else:?>
				<span>...</span>
				<?php endif;?>
			</div>
			<?php endforeach;?>
		</div>
	
	
	    <div class="card">
	        <?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);?>
	    </div>

    <?php ActiveForm::end(); ?>

</div>
