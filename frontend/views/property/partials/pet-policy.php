<?php if(!empty($property->pet_policy)):?>
	<div class="card">
		<div class="card__header">
			<h2><?=$property->title;?> Pet policy</h2>
		</div>
		<div class="card__body">
			<?=$property->pet_policy;?>
		</div>
	</div>
<?php endif;?>
