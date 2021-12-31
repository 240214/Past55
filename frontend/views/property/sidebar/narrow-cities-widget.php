<?php
use yii\helpers\Url;
use yii\helpers\VarDumper;
$widget_class = $display_narrow_cities ? '' : 'hide';
?>
<?php if($with_wrap):?>
<div id="js_narrow_cities_widget" class="filter-box p-35 mb-2 <?=$widget_class;?>">
<?php endif;?>
	<?php if($display_narrow_cities):?>
		<div class="filter-box__title mb-2">Narrow your search</div> <small class="d-none"><?=count($narrow_cities);?></small>
		<ul class="d-flex flex-wrap list-wrap">
			<?php foreach($narrow_cities as $city):?>
				<a href="<?=Url::toRoute(['property/index'] + $city);?>" class="filter-box__btn trans-me"><?=$city['city_label'];?></a>
			<?php endforeach;?>
		</ul>
	<?php endif;?>
<?php if($with_wrap):?>
</div>
<?php endif;?>
