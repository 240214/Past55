<?php if(!empty($property->nearby_places)):?>
<div class="card-box big">
	<div class="header">
		<h2 class="title"><?=$property->title;?> Nearby Places</h2>
	</div>
	<div class="body">
		<ul class="nav nav-tabs js_nav_tabs" id="myTab" role="tablist">
			<?php $i=0; foreach($property->nearby_places as $name => $nearby_place): $i++;?>
			<?php $css_class = ($i == 1) ? 'active' : ''; ?>
			<?php $selected = ($i == 1) ? 'true' : 'false'; ?>
			<li data-id="<?=$name;?>-tab" class="nav-item" role="presentation">
				<button class="nav-link <?=$css_class;?>" id="<?=$name;?>-tab" data-bs-toggle="tab" data-bs-target="#<?=$name;?>" type="button" role="tab" aria-controls="<?=$name;?>" aria-selected="<?=$selected;?>" data-trigger="js_action_click" data-action="nav_tab_dd_item_select"><?=$nearby_place['label'];?></button>
			</li>
			<?php endforeach;?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">More</a>
				<ul class="dropdown-menu">
					<?php $i=0; foreach($property->nearby_places as $name => $nearby_place): $i++;?>
						<?php $css_class = ($i == 1) ? 'active' : ''; ?>
						<?php $selected = ($i == 1) ? 'true' : 'false'; ?>
						<li data-id="clone-<?=$name;?>-tab" class="nav-item" role="presentation">
							<button class="nav-link <?=$css_class;?>" id="clone_<?=$name;?>-tab" data-bs-toggle="tab" data-bs-target="#<?=$name;?>" type="button" role="tab" aria-controls="clone_<?=$name;?>" aria-selected="<?=$selected;?>" data-trigger="js_action_click" data-action="nav_tab_dd_item_select"><?=$nearby_place['label'];?></button>
						</li>
					<?php endforeach;?>
				</ul>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">
			<?php $i=0; foreach($property->nearby_places as $name => $nearby_place): $i++;?>
			<?php $css_class = ($i == 1) ? 'show active' : ''; ?>
			<div class="tab-pane fade <?=$css_class;?>" id="<?=$name;?>" role="tabpanel" aria-labelledby="<?=$name;?>-tab">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Place</th>
							<th>Distance</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($nearby_place['items'] as $item):?>
						<tr id="<?=$item['place_id'];?>">
							<td><?=$item['name'];?> <i class="zmdi zmdi-info-outline" data-bs-toggle="tooltip" data-bs-placement="top" title='<img src="<?=$item['icon_url'];?>"> <?=$item['address'];?>'></i></td>
							<td><?=$item['distance'];?> <?=$item['distance_type'];?></td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
			</div>
			<?php endforeach;?>
		</div>
	</div>
</div>
<?php endif;?>

