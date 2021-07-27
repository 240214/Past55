<?php if(!empty($property->features)):?>
	<div class="card">
		<div class="card__header">
			<h2><?=$property->title;?> Amenities</h2>
			<small>Maecenas seddiam eget risus varius blandit sitamet nonmagna</small>
		</div>
		<div class="card__body trans_all">
			<div class="features cols">
				<?php foreach($property->features as $feature):?>
					<div class="group less">
						<h3 class="title"><?=$feature['title'];?></h3>
						<ul class="list">
							<?php foreach($feature['items'] as $item):?>
								<li class="name"><i class="zmdi zmdi-check zmdi-hc-fw"></i><?=$item['name'];?></li>
							<?php endforeach;?>
						</ul>
						<?php if(count($feature['items']) > 6):?>
						<a role="button" class="show-more-less" data-trigger="js_action_click" data-action="toggle_features_view">
							<span>Show more</span>
						</a>
						<?php endif;?>
					</div>
				<?php endforeach;?>
			</div>
		</div>
	</div>
<?php endif;?>
