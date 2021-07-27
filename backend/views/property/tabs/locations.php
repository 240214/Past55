<?php
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\helpers\Json;

#VarDumper::dump($model->nearby_places, 10, 1); exit;
?>
<div class="row">
	<div id="type-selector" class="pac-controls col-md-12 check-container">
		<div class="check-item">
			<input type="radio" name="type" id="changetype-all" checked="checked" value="all">
			<label for="changetype-all"><i class="fa fa-check"></i>All</label>
		</div>
		<div class="check-item">
			<input type="radio" name="type" id="changetype-establishment" value="establishment">
			<label for="changetype-establishment"><i class="fa fa-check"></i>Establishments</label>
		</div>
		<div class="check-item">
			<input type="radio" name="type" id="changetype-address" value="address">
			<label for="changetype-address"><i class="fa fa-check"></i>Addresses</label>
		</div>
		<div class="check-item">
			<input type="radio" name="type" id="changetype-geocode" value="geocode">
			<label for="changetype-geocode"><i class="fa fa-check"></i>Geocodes</label>
		</div>
		<div class="check-item">
			<input type="checkbox" id="use-strict-bounds" value="">
			<label for="use-strict-bounds"><i class="fa fa-check"></i>Strict Bounds</label>
		</div>
	</div>
</div>

<hr>

<div id="pac-container" class="row">
	<div class="col-md-12">
		<?=$form->field($model, 'address')->textInput(['id' => 'pac-input', 'class' => 'form-control', 'placeholder' => 'Enter a location'])->label('Full Address');?>
	</div>
</div>

<div id="map_constructor" class="bg-loader">
	<div id="map_canvas" class="maps-canvas" style="height:100%; width:100%;"></div>
</div>
<div id="infowindow-content">
	<img id="place-icon" src="">
	<div id="place-name"></div>
	<div id="place-address"></div>
</div>
<div class="fields-toggle-row mt-15 text-center">
	<a role="button" class="btn-smf" data-trigger="js_action_click" data-action="toggle_more_location_fields" data-target="#js_more_location_fields">Show more fields</a>
</div>
<hr class="clearfix">

<div id="js_more_location_fields" class="more-fields">
	<div class="row">
		<div class="col-md-3">
			<?=$form->field($model, 'location')->textInput(['id' => 'street', 'class' => 'form-control'])->label('Street / Location');?>
		</div>
		<div class="col-md-3">
			<?=$form->field($model, 'prop_number')->textInput(['id' => 'number', 'class' => 'form-control'])->label('Item number');?>
		</div>
		<div class="col-md-3">
			<?=$form->field($model, 'address_lat')->textInput(['id' => 'lat', 'class' => 'form-control']);?>
		</div>
		<div class="col-md-3">
			<?=$form->field($model, 'address_lng')->textInput(['id' => 'lng', 'class' => 'form-control']);?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-3">
			<?=$form->field($model, 'city')->textInput(['id' => 'town', 'class' => 'form-control']);?>
		</div>
		<div class="col-md-3">
			<?=$form->field($model, 'zipcode')->textInput(['id' => 'zip', 'class' => 'form-control']);?>
		</div>
		<div class="col-md-3">
			<?=$form->field($model, 'state')->textInput(['id' => 'region', 'class' => 'form-control']);?>
		</div>
		<div class="col-md-3">
			<?=$form->field($model, 'country')->textInput(['id' => 'country', 'class' => 'form-control']);?>
		</div>
	</div>
</div>
<?=$form->field($model, 'nearby_places')->hiddenInput(['id' => 'js_nearby_places_input'])->label(false);?>
<?php #=Html::hiddenInput('Property[nearby_places]', $model->nearby_places, ['id' => 'js_nearby_places_input']);?>

<hr>

<div class="nearby_places_wrap">
	<h4>Nearby places</h4>
	<div class="form-np">
		<label>Search radius (in meters):</label>
		<?=$form->field($model, 'radius')->input('number', ['id' => 'js_nearby_places_radius', 'step' => 10, 'min' => 0, 'max' => 50000, 'size' => 10, 'value' => $model->isNewRecord ? 5000 : $model->radius])->label(false);?>
		<?php //=Html::input('number', 'radius', 5000, ['id' => 'js_nearby_places_radius', 'class' => 'form-control dib w-auto', 'step' => 10, 'min' => 0, 'max' => 50000, 'size' => 10]);?>
		<?=Html::button('Get nearby places', ['id' => 'js_get_nearby_places', 'class' => 'btn btn-warning', 'disabled' => 'disabled']);?>
	</div>
	<div id="nearby_places_container" class="nearby-places-container">
		<?php if(!empty($model->nearby_places)): $nearby_places = Json::decode($model->nearby_places, true);?>
			<table class="table table-striped table-bordered">
				<thead><tr><th>Icon</th><th>Name</th><th>Category</th><th>Distance</th><th>Rating</th></tr></thead>
				<tbody>
				<?php foreach($nearby_places as $place):?>
					<tr>
						<td><img class="loc-icon" src="<?=$place['icon_url'];?>"></td>
						<td><?=$place['name'];?></td>
						<td><?=str_replace('_', ' ', $place['type']);?></td>
						<td><?=$place['distance'];?> <?=$place['distance_type'];?></td>
						<td><?=$place['rating'];?></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		<?php endif;?>
	</div>
</div>
