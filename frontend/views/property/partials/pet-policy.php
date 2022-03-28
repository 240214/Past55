<?php if(!empty($property->pet_policy)):?>
	<div class="card-box big">
		<div class="header">
			<h2 class="title"><?=$property->title;?> Pet policy</h2>
		</div>
		<div class="body">
			<?=$property->pet_policy;?>
		</div>
	</div>
<?php endif;?>
