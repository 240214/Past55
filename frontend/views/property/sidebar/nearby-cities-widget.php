<?php
use yii\helpers\Url;
use yii\helpers\VarDumper;
$widget_class = $display_nearby_cities ? '' : 'hide';
?>
<?php if($with_wrap):?>
<div id="js_nearby_cities_widget" class="filter-box p-35 mb-2 <?=$widget_class;?>">
<?php endif;?>
	<?php if($display_nearby_cities):?>
		<div class="filter-box__title mb-2">Nearby cities</div> <small class="d-none"><?=count($nearby_cities);?></small>
		<div class="d-flex flex-wrap list-wrap">
			<?php foreach($nearby_cities as $city):?>
				<a href="<?=Url::toRoute(['property/index'] + $city);?>" class="filter-box__btn trans-me"><?=$city['city_label'];?></a>
			<?php endforeach;?>
		</div>
	<?php endif;?>
<?php if($with_wrap):?>
</div>
<?php endif;?>
