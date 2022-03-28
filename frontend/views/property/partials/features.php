<?php if(!empty($property->features)):?>
	<div class="card-box big">
		<div class="header">
			<h2 class="title"><?=$property->title;?> Amenities</h2>
			<div class="subtitle">Maecenas seddiam eget risus varius blandit sitamet nonmagna</div>
		</div>
		<div class="body mt-2 mt-md-3">
			<div class="features cols">
				<?php foreach($property->features as $feature):?>
					<div class="group less">
						<h3 class="title"><?=$feature['title'];?></h3>
						<ul class="list">
							<?php foreach($feature['items'] as $item):?>
								<li class="name"><i class="bi bi-check2"></i><?=$item['name'];?></li>
							<?php endforeach;?>
						</ul>
						<?php if(count($feature['items']) > 6):?>
						<a role="button" class="show-more-less mt-25" data-trigger="js_action_click" data-action="toggle_features_view">Show more</a>
						<?php endif;?>
					</div>
				<?php endforeach;?>
			</div>
		</div>
	</div>
<?php endif;?>
