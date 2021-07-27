<?php

use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;

#$session = Yii::$app->session;
?>
<div id="infowindow-content">
	<img id="place-icon" src="">
	<div id="place-name"></div>
	<div id="place-address"></div>
</div>
<div class="card">
	<div class="card__header">
		<h2><?=$property->title;?> Location</h2>
		<small class="address"><i class="zmdi zmdi-pin me-2"></i><?=$property->address;?></small>
	</div>
	<div class="card__body">
		<div class="row">
			<div class="col-12">
				<input type="hidden" id="property_lat" value="<?=$property->address_lat;?>">
				<input type="hidden" id="property_lng" value="<?=$property->address_lng;?>">
				<div id="map_constructor" class="bg-loader">
					<div id="map_canvas" class="maps-canvas" style="height:100%; width:100%;"></div>
				</div>
			</div>
		</div>
	</div>
</div>
