<div class="card-box big">
	<div class="header">
		<h2 class="title"><?=$property->title;?> Location</h2>
		<small class="address mb-3"><i class="bi bi-geo-alt-fill me-1 text-color-primary"></i><?=$property->address;?></small>
	</div>
	<div class="body">
		<input type="hidden" id="property_lat" value="<?=$property->address_lat;?>">
		<input type="hidden" id="property_lng" value="<?=$property->address_lng;?>">
		<div id="map_constructor" class="bg-loader">
			<div id="map_canvas" class="maps-canvas"></div>
		</div>
	</div>
</div>
