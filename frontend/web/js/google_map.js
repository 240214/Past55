/**
 * @Author : Armen
 * JS Plugin that uses Google Map Geocode Api.
 * Used for address suggestion
 */

function initMap(){
	MapJS.Init();
}

var MapJS = {
	objects: {
		autocompletes: null,
		propLatlng: null,
	},
	vars: {
		suggestedAddresses: [],
		selectedAddressIndex: 0,
		zoom: 17,
		property: {
			lat: 37.8688,
			lng: -99.2195
		},
	},
	els: {},
	Init: function(){
		this.vars.property.lat = $('#property_lat').val();
		this.vars.property.lng = $('#property_lng').val();
		this.objects.propLatlng = new google.maps.LatLng(this.vars.property.lat, this.vars.property.lng);

		this.initAutocomplete();
		this.initGoogleMap();
		this.initEvents();
	},
	initEvents: function(){},
	initGoogleMap: function(){
		var map_canvas = document.getElementById('map_canvas');
		if(map_canvas != null){
			var map = new google.maps.Map(map_canvas, {center: MapJS.objects.propLatlng, zoom: MapJS.vars.zoom});

			var marker = new google.maps.Marker({
				position: MapJS.objects.propLatlng,
				map: map,
				draggable: false,
				animation: google.maps.Animation.DROP,
			});
			map.panTo(MapJS.objects.propLatlng);
		}
	},
	initAutocomplete: function(){
		var $inputs = $('.js_customer_address_address');

		$inputs.each(function(i, input){
			var loaded = $(input).data('loaded');

			if(loaded == 0){
				var autocomplete = new google.maps.places.Autocomplete(input);
				autocomplete.addListener('place_changed', function(){
					var distance_type = 'miles';
					var place = this.getPlace();
					var lat = place.geometry.location.lat();
					var lng = place.geometry.location.lng();
					var myLatlng = new google.maps.LatLng(lat, lng);
					var distance = google.maps.geometry.spherical.computeDistanceBetween(MapJS.objects.propLatlng, myLatlng);

					distance = distance / 1609;
					distance = distance.toFixed(2);
					//console.log('distance', distance, distance_type);

					var $js_distance_col = $(input).parent('.js_address_col').siblings('.js_distance_col');
					if($js_distance_col.find('.js_customer_distance_label').length){
						$js_distance_col.find('.js_customer_distance_label').text(distance + ' ' + distance_type);
					}
					if($js_distance_col.find('.js_customer_address_lat').length){
						$js_distance_col.find('.js_customer_address_lat').val(lat);
					}
					if($js_distance_col.find('.js_customer_address_lng').length){
						$js_distance_col.find('.js_customer_address_lng').val(lng);
					}
					/*if($js_distance_col.find('.js_customer_distance').length){
						$js_distance_col.find('.js_customer_distance').val(distance);
					}
					if($js_distance_col.find('.js_customer_distance_type').length){
						$js_distance_col.find('.js_customer_distance_type').val(distance_type);
					}*/
				});
				$(input).data('loaded', 1);
			}
		});
	},
};
