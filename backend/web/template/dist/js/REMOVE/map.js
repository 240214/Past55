if(typeof jQuery === "undefined"){
	throw new Error("Myadmin requires jQuery");
}

$(function(){
	"use strict";

	var MAPJS = {
		options: {
			zoom: 6,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			panControl: false,
			zoomControl: true,
			mapTypeControl: true,
			scaleControl: true,
			streetViewControl: false,
			overviewMapControl: false
		},
		urls: {
			backend_url: '/backend/web',
			frontend_url: '',
			property: {
				remove_image: '/backend/web/property/remove-image/',
			}
		},
		obj: {
			map_c: null,
			marker: null,
		},
		vars: {
			maps_initialized: false,
			marker_added: false,
		},
		lang: {
			map_marker_title: "Me You can move!",
		},
		Init: function(){
			this.initEvents();
			if(!this.vars.maps_initialized)
				this.initMaps();
		},
		initEvents: function(){},
		initMaps: function(){
			var myLatlng = new google.maps.LatLng($("#address_lat").val(),$("#address_lng").val());
			var mapOptions = $.extend(MAPJS.options, {center: myLatlng});
			MAPJS.obj.map_c = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
			/*map_p = new google.maps.Map(document.getElementById('map_preview'), mapOptions);

			circleOptions = {
				strokeColor: '#cc0000',
				strokeOpacity: 0.8,
				strokeWeight: 0,
				fillColor: '#cc0000',
				fillOpacity: 0.35,
				map: map_p,
				center: myLatlng,
				radius: 10000,
			};
			cityCircle = new google.maps.Circle(circleOptions);*/

			google.maps.event.addListener(MAPJS.obj.map_c, 'click', function(event){
				if(MAPJS.vars.marker_added){
					MAPJS.obj.marker.setMap(null);
					MAPJS.vars.marker_added = false;
				}
				if(!MAPJS.vars.marker_added)
					MAPJS.addMarker(event.latLng, true);
			});

			/*google.maps.event.addListener(MAPJS.obj.map_c, 'dragend', function(){
				map_p.panTo(MAPJS.obj.map_c.getCenter());
			});
			google.maps.event.addListener(MAPJS.obj.map_c, 'zoom_changed', function(){
				map_p.setZoom(MAPJS.obj.map_c.getZoom());
				map_p.panTo(MAPJS.obj.map_c.getCenter());
			});	*/

			if(!MAPJS.vars.marker_added && myLatlng != null)
				MAPJS.addMarker(myLatlng, false);

			MAPJS.initPlaces();

			MAPJS.vars.maps_initialized = true;
			//$("#map_canvas").removeClass("bg-loader");
		},
		initPlaces: function(){
			var address_input = document.getElementById('pac-input');
			var a_options = {types: ['geocode']};
			var autocomplete = new google.maps.places.Autocomplete(address_input, a_options);
			var infowindow = new google.maps.InfoWindow();

			autocomplete.bindTo('bounds', MAPJS.obj.map_c);
			autocomplete.setTypes(['geocode']);

			google.maps.event.addListener(autocomplete, 'place_changed', function(){
				infowindow.close();
				MAPJS.obj.marker.setVisible(false);
				var place = autocomplete.getPlace();
				if(!place.geometry){
					return;
				}
				// If the place has a geometry, then present it on a map.
				if(place.geometry.viewport){
					MAPJS.obj.map_c.fitBounds(place.geometry.viewport);
				}else{
					MAPJS.obj.map_c.setCenter(place.geometry.location);
					MAPJS.obj.map_c.setZoom(17);  // Why 17? Because it looks good.
				}
				MAPJS.obj.marker.setPosition(place.geometry.location);
				MAPJS.obj.marker.setVisible(true);

				var address = '';
				if(place.address_components){
					address = [
						(place.address_components[0] && place.address_components[0].short_name || ''),
						(place.address_components[1] && place.address_components[1].short_name || ''),
						(place.address_components[2] && place.address_components[2].short_name || '')
					].join(' ');
				}

				infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
				infowindow.open(MAPJS.obj.map_c, MAPJS.obj.marker);

				var post_params = {"geocode": {"lat": place.geometry.location.lat(), "lng": place.geometry.location.lng()}};
				MAPJS.fillAddress(post_params);

				//$("input.a_el").val('').attr("readonly", false);
				//var post_params = {"location": $("#address_data").val()};
				//MAPJS.fillAddress(post_params);
			});
		},
		addMarker: function(location, get_address){
			MAPJS.obj.marker = new google.maps.Marker({
				position: location,
				map: MAPJS.obj.map_c,
				title: MAPJS.lang.map_marker_title,
				draggable: true,
				animation: google.maps.Animation.DROP,
			});

			MAPJS.obj.map_c.panTo(location);

			if(get_address){
				var post_params = {"geocode": {"lat": location.lat(), "lng": location.lng()}};
				MAPJS.fillAddress(post_params);
			}

			google.maps.event.addListener(MAPJS.obj.marker, 'dragend', function(){
				var marker_location = MAPJS.obj.marker.getPosition();
				var post_params = {"geocode": {"lat": marker_location.lat(), "lng": marker_location.lng()}};
				MAPJS.obj.map_c.panTo(marker_location);
				//map_p.panTo(marker_location);
				//console.log(post_params);
				MAPJS.fillAddress(post_params);
			});

			MAPJS.vars.marker_added = true;
		},
		createMapPreview: function(){
			$("#map_viewer").fadeIn(500, function(){
				var myLatlng = new google.maps.LatLng($("#address_lat").val(),$("#address_lng").val());
				var mapOptions = $.extend(MAPJS.options, {center: myLatlng, zoom: 17});
				var map_p = new google.maps.Map(document.getElementById('map_preview'), mapOptions);

				var circleOptions = {
					strokeColor: '#cc0000',
					strokeOpacity: 0.8,
					strokeWeight: 0,
					fillColor: '#cc0000',
					fillOpacity: 0.35,
					map: map_p,
					center: myLatlng,
					radius: 100,
				};
				var cityCircle = new google.maps.Circle(circleOptions);
				$.scrollTo("#map_viewer", 800);
			}).find(".popup_win_inner").animate({"top": $("#tabs-2 .ftable").offset().top-100}, 500);
		},
		closeMapPreview: function(){
			$("#map_viewer").fadeOut(500, function(){
				$("#map_preview").empty();
			});
		},
		fillAddress: function(post_params){
			//console.log(post_params);
			$("input.a_el").val("");

			$.ajax({
				loaderTitle: '<{$smarty.const._AJAX_LOADING_DATA}>',
				loaderAutoHide: true,
				type: "POST",
				url: "<{$xoops_url}>/ajax/convert_places.php",
				data: post_params,
				dataType: "json"
			}).done(function(data){
				if(data.error == 1){
					console.error(data.message);
				}else{
					$.each(data.result, function(index, value){
						$("input.a_el[gname="+index+"]").val(value).attr("readonly", false);
					});
					MAPJS.fillAddressData();
				}
			});

		},
		clearAddress: function(id){
			if(id == 'all'){
				$(".adds").val("");
			}else $("#"+id).val("");
		},
		fillAddressData: function(){
			var address_arr = [];
			var a_data = "";

			$("input.a_elf").each(function(index, element){
				address_arr.push($(this).val());
			});
			a_data = address_arr.join(", ");

			$("#address_data").val(a_data);
			/*if($("#address_lang").val() == "")
				$("#address_lang").val(a_data);*/
		},
	};

	MAPJS.Init();
});

