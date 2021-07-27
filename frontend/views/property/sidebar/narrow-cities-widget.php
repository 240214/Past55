<?php
use yii\helpers\Url;
use yii\helpers\VarDumper;
?>
<?php if($with_wrap):?>
<div id="js_narrow_cities_widget">
<?php endif;?>
	<?php if($display_narrow_cities):?>
	<div class="card">
		<div class="header">
			<h2>Narrow your search box</h2>
			<small class="">Found locations: <?=count($narrow_cities);?></small>
		</div>
		<div class="body">
			<ul class="list-link">
				<?php foreach($narrow_cities as $city):?>
					<li class="item"><a href="<?=Url::toRoute(['property/index'] + $city);?>"><i class="zmdi zmdi-pin me-2"></i> <?=$city['city_label'];?></a></li>
				<?php endforeach;?>
			</ul>
		</div>
	</div>
	<?php endif;?>
<?php if($with_wrap):?>
</div>
<?php endif;?>
