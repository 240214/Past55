<?php if(!empty($property->description)):?>
	<div class="card">
		<div class="card__header">
			<h2>About <?=$property->title;?></h2>
		</div>
		<div class="card__body">
			<?=$property->description;?>
		</div>
	</div>
<?php endif;?>
