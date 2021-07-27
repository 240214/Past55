<?php if(!empty($property->features)):?>
	<div class="card">
		<div class="card__header">
			<h2>Some of our awesome features</h2>
			<small>Maecenas seddiam eget risus varius blandit sitamet nonmagna</small>
		</div>
		<div class="card__body">
			<div class="features icons">
				<?php foreach($property->features as $feature):?>
					<div class="group">
						<h3 class="title"><?=$feature['title'];?></h3>
						<ul class="list">
							<?php foreach($feature['items'] as $item):?>
								<li>
									<i class="<?=$item['image'];?>"></i>
									<span class="name"><?=$item['name'];?></span>
								</li>
							<?php endforeach;?>
						</ul>
					</div>
				<?php endforeach;?>
			</div>
		</div>
	</div>
<?php endif;?>
