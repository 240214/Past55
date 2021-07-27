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
		map: null,
		marker: null,
		geocoder: null,
		myLatlng: null,
		autocomplete: null,
		infowindow: null,
	},
	vars: {
		marker_added: false,
		suggestedAddresses: [],
		selectedAddressIndex: 0,
		zoom: 5,
		nearby_places_data: [],
	},
	els: {
		map_canvas: null,
		lat: null,
		lng: null,
		input: null,
		infowindowContent: null,
		use_strict_bounds: null,
		changetype_all: null,
		changetype_address: null,
		changetype_establishment: null,
		changetype_geocode: null,
		js_get_nearby_places: null,
		nearby_places_container: null,
		js_data_loader: $('#js_data_loader'),
		js_nearby_places_radius: $('#js_nearby_places_radius'),
		js_nearby_places_input: $('#js_nearby_places_input'),
	},
	fields: {
		street_number_input: {id: "number", label: "Number:"},
		street_name_input: {id: "street", label: "street:"},
		zip_input: {id: "zip", label: "Zip Code:"},
		town_input: {id: "town", label: "City:"},
		department_input: {id: "department", label: "Departement"},
		region_input: {id: "region", label: "Region/State:"},
		country_input: {id: "country", label: "Country"},
		address_lat: {id: "lat", label: "Latitude"},
		address_lng: {id: "lng", label: "Longitude"},
	},
	Init: function(){
		this.els.map_canvas = document.getElementById('map_canvas');
		if(this.els.map_canvas != null){
			this.els.lat = document.getElementById('lat');
			this.els.lng = document.getElementById('lng');
			this.els.input = document.getElementById('pac-input');
			this.els.infowindowContent = document.getElementById('infowindow-content');
			this.els.use_strict_bounds = document.getElementById('use-strict-bounds');
			this.els.changetype_all = document.getElementById('changetype-all');
			this.els.changetype_address = document.getElementById('changetype-address');
			this.els.changetype_establishment = document.getElementById('changetype-establishment');
			this.els.changetype_geocode = document.getElementById('changetype-geocode');
			this.els.js_get_nearby_places = $('#js_get_nearby_places');
			this.els.nearby_places_container = $('#nearby_places_container');

			this.vars.zoom = (this.els.lat.value == 0 || this.els.lng.value == 0) ? 5 : 17;

			if(this.els.lat.value == 0) this.els.lat.value = 37.8688;
			if(this.els.lng.value == 0) this.els.lng.value = -99.2195;

			this.objects.geocoder = new google.maps.Geocoder();
			this.objects.myLatlng = new google.maps.LatLng(this.els.lat.value, this.els.lng.value);
			this.objects.map = new google.maps.Map(this.els.map_canvas, {center: this.objects.myLatlng, zoom: this.vars.zoom});
			this.objects.autocomplete = new google.maps.places.Autocomplete(this.els.input);
			this.objects.infowindow = new google.maps.InfoWindow();
			this.objects.infowindow.setContent(this.els.infowindowContent);

			this.initEvents();

			if(!this.vars.marker_added && this.objects.myLatlng != null){
				this.addMarker(this.objects.myLatlng, false);
			}
		}
	},
	initEvents: function(){
		MapJS.objects.autocomplete.bindTo('bounds', MapJS.objects.map);
		MapJS.objects.autocomplete.addListener('place_changed', MapJS.autocompleteInput);
		google.maps.event.addListener(MapJS.objects.map, 'click', MapJS.mapClick);
		MapJS.els.use_strict_bounds.addEventListener('click', MapJS.useStrictBoundsClick);
		MapJS.els.changetype_all.addEventListener('click', MapJS.changeTypeClick);
		MapJS.els.changetype_address.addEventListener('click', MapJS.changeTypeClick);
		MapJS.els.changetype_establishment.addEventListener('click', MapJS.changeTypeClick);
		MapJS.els.changetype_geocode.addEventListener('click', MapJS.changeTypeClick);

		$(document)
			.on('click', '#js_get_nearby_places', MapJS.getNearbyPlaces)
			.on('change input', '#js_nearby_places_radius', MapJS.changeNearbyRadiusInput);

	},
	loader: function(status){
		if(status)
			MapJS.els.js_data_loader.addClass('show');
		else
			MapJS.els.js_data_loader.removeClass('show');
	},
	changeNearbyButtonStatus: function(status){
		if(status == undefined){
			status = false;
		}

		MapJS.els.js_get_nearby_places.prop('disabled', status);
	},
	changeNearbyRadiusInput: function(e){
		MapJS.changeNearbyButtonStatus(false);
	},
	autocompleteInput: function(){
		MapJS.objects.infowindow.close();
		MapJS.objects.marker.setVisible(false);
		var place = MapJS.objects.autocomplete.getPlace();
		if(!place.geometry){
			window.alert("No details available for input: '" + place.name + "'");
			return;
		}

		// If the place has a geometry, then present it on a map.
		if(place.geometry.viewport){
			MapJS.objects.map.fitBounds(place.geometry.viewport);
		}else{
			MapJS.objects.map.setCenter(place.geometry.location);
			MapJS.objects.map.setZoom(MapJS.vars.zoom);
		}
		MapJS.objects.marker.setPosition(place.geometry.location);
		MapJS.objects.marker.setVisible(true);

		var address = '';
		if(place.address_components){
			address = [
				(place.address_components[0] && place.address_components[0].short_name || ''),
				(place.address_components[1] && place.address_components[1].short_name || ''),
				(place.address_components[2] && place.address_components[2].short_name || '')
			].join(' ');
		}

		MapJS.els.infowindowContent.children['place-icon'].src = place.icon;
		MapJS.els.infowindowContent.children['place-name'].textContent = place.name;
		MapJS.els.infowindowContent.children['place-address'].textContent = address;
		MapJS.objects.infowindow.open(MapJS.objects.map, MapJS.objects.marker);
		MapJS.extractData([place]);
		MapJS.fillFields();
	},
	extractData: function(receivedAddresses){
		MapJS.vars.suggestedAddresses = [];
		receivedAddresses.forEach(function(addressComponent){
			var address = {};
			address.formatted = addressComponent.formatted_address;
			address.latlng = addressComponent.geometry.location;
			address.detail = {};
			addressComponent.address_components.forEach(function(component){
				if(component.types.indexOf("street_number") > -1){
					// set numero
					address.detail.number = component.long_name;
				}
				if(component.types.indexOf("route") > -1){
					// set voie
					address.detail.street = component.long_name;
				}
				if(component.types.indexOf("locality") > -1){
					// set ville
					address.detail.town = component.long_name;
				}
				if(component.types.indexOf("administrative_area_level_2") > -1){
					// set departement
					address.detail.department = component.long_name;
				}
				if(component.types.indexOf("administrative_area_level_1") > -1){
					// set region
					address.detail.region = component.long_name;
				}
				if(component.types.indexOf("country") > -1){
					// set pays
					address.detail.country = component.long_name;
				}
				if(component.types.indexOf("postal_code") > -1){
					// set code postal
					address.detail.zip = component.long_name;
				}
			});
			MapJS.vars.suggestedAddresses.push(address);
		});
	},
	getAddress: function(latLng){
		MapJS.objects.geocoder.geocode({'latLng': latLng}, function(results, status){
			if(status == google.maps.GeocoderStatus.OK){
				if(results[0]){
					document.getElementById("pac-input").value = results[0].formatted_address;
					MapJS.extractData(results);
					MapJS.fillFields();
				}else{
					document.getElementById("pac-input").value = "No results";
				}
			}else{
				document.getElementById("pac-input").value = status;
			}
		});
	},
	fillFields: function(){
		$.each(MapJS.fields, function(){
			var value = MapJS.vars.suggestedAddresses[MapJS.vars.selectedAddressIndex].detail[this.id];
			if(this.id == 'lat' || this.id == 'lng'){
				value = MapJS.vars.suggestedAddresses[MapJS.vars.selectedAddressIndex].latlng[this.id];
			}
			$("#" + this.id).val(value);
		});
	},
	addMarker: function(location, get_address){
		var post_params = {};

		MapJS.objects.marker = new google.maps.Marker({
			position: location,
			map: MapJS.objects.map,
			title: 'You can move me :)',
			draggable: true,
			animation: google.maps.Animation.DROP,
		});

		MapJS.objects.map.panTo(location);

		if(get_address){
			post_params = {"geocode": {"lat": location.lat(), "lng": location.lng()}};
			MapJS.getAddress(post_params.geocode);
			MapJS.changeNearbyButtonStatus(false);
		}

		google.maps.event.addListener(MapJS.objects.marker, 'dragend', MapJS.markerDraged);

		MapJS.vars.marker_added = true;
	},
	markerDraged: function(){
		var marker_location = MapJS.objects.marker.getPosition();
		var post_params = {"geocode": {"lat": marker_location.lat(), "lng": marker_location.lng()}};
		MapJS.objects.map.panTo(marker_location);
		MapJS.getAddress(post_params.geocode);
		MapJS.changeNearbyButtonStatus(false);
	},
	mapClick: function(event){
		if(MapJS.vars.marker_added){
			MapJS.objects.marker.setMap(null);
			MapJS.vars.marker_added = false;
		}
		if(!MapJS.vars.marker_added)
			MapJS.addMarker(event.latLng, true);
	},
	useStrictBoundsClick: function(){
		MapJS.objects.autocomplete.setOptions({strictBounds: this.checked});
	},
	changeTypeClick: function(e){
		switch(this.value){
			case "all":
				MapJS.objects.autocomplete.setTypes([]);
				break;
			default:
				MapJS.objects.autocomplete.setTypes([this.value]);
				break;
		}
	},
	getNearbyPlaces: function(){
		MapJS.loader(true);
		MapJS.els.nearby_places_container.text('');
		MapJS.vars.nearby_places_data = [];

		var request = {
			location: new google.maps.LatLng(MapJS.els.lat.value, MapJS.els.lng.value),
			//bounds: MapJS.objects.map.getBounds(),
			radius: MapJS.els.js_nearby_places_radius.val(),
			//type: nearby_places_types,
		};
		//console.log(request);

		var service = new google.maps.places.PlacesService(MapJS.objects.map);
		//use only the name of the function as callback-argument
		service.nearbySearch(request, MapJS.handleSearchResults);

		MapJS.changeNearbyButtonStatus(true);
	},
	handleSearchResults: function(results, status, pagination){
		if(status == google.maps.places.PlacesServiceStatus.OK){
			console.log("results count:", results.length);
			//console.log(results);

			for(var i = 0; i < results.length; i++){
				var distance_type = 'miles';
				var distance = google.maps.geometry.spherical.computeDistanceBetween(MapJS.objects.marker.getPosition(), results[i].geometry.location);
				distance = distance / 1609;
				distance = distance.toFixed(2);

				/*var distance_v = Math.round(distance / 1000);
				var distance_type = 'km';

				if(distance_v == 0){
					distance_v = Math.round(distance / 10) * 10;
					distance_type = 'm';
				}*/

				//console.log(results[i].name, distance);

				MapJS.vars.nearby_places_data.push({
					"place_id": results[i].place_id,
					"rating": results[i].rating == undefined ? 0 : results[i].rating,
					//"location": results[i].geometry.location,
					"lat": results[i].geometry.location.lat(),
					"lng": results[i].geometry.location.lng(),
					"name": results[i].name,
					"address": results[i].vicinity,
					"types": results[i].types,
					"icon_url": results[i].icon,
					//"photos": results[i].photos,
					"distance": distance,
					"distance_type": distance_type,
				});
			}
		}
		if(pagination.hasNextPage){
			sleep:5;
			pagination.nextPage();
		}else{
			MapJS.filterNearbyData();
		}
	},
	filterNearbyData: function(){
		var nearby_places_data = MapJS.vars.nearby_places_data;
		MapJS.vars.nearby_places_data = [];

		$.each(nearby_places_data, function(i, data){
			$.each(data.types, function(k, type){
				if($.inArray(type, nearby_places_types) != -1){
					MapJS.vars.nearby_places_data.push({
						"place_id": data.place_id,
						"rating": data.rating,
						"lat": data.lat,
						"lng": data.lng,
						"name": data.name,
						"address": data.address,
						"type": type,
						"icon_url": data.icon_url,
						"distance": data.distance,
						"distance_type": data.distance_type,
					});
				}
			});
		});

		console.log("filtered data count:", MapJS.vars.nearby_places_data.length);
		//console.log(MapJS.vars.nearby_places_data);

		MapJS.els.js_nearby_places_input.val(JSON.stringify(MapJS.vars.nearby_places_data));
		MapJS.createNearbyPlacesTable();
	},
	createNearbyPlacesTable(){
		if(MapJS.vars.nearby_places_data.length){
			var $table = $('<table>'),
				$thead = $('<thead>'),
				$tbody = $('<tbody>'),
				html = '';

			html += '<tr><th>Icon</th><th>Name</th><th>Category</th><th>Distance</th><th>Rating</th></tr>';
			$thead.html(html);

			$.each(MapJS.vars.nearby_places_data, function(i, data){
				//console.log(data);
				var $tr = $('<tr>');
				$tr.attr('id', data.place_id);
				var html = '<td><img class="loc-icon" src="'+data.icon_url+'"></td>';
				html += '<td>'+data.name+'</td>';
				html += '<td>'+data.type.replaceAll('_', ' ')+'</td>';
				html += '<td>'+data.distance + ' ' + data.distance_type+'</td>';
				html += '<td>'+data.rating+'</td>';
				$tr.html(html);
				$tbody.append($tr);
			});

			$table.addClass('table table-striped table-bordered').append($thead).append($tbody);

			MapJS.els.nearby_places_container.html($table);
		}

		MapJS.loader(false);
	},
	getNearbyPlaces2: function(){
		$.ajax({
			/*beforeSend: function(request) {
				request.setRequestHeader("Access-Control-Allow-Origin", "*");
			},*/
			//headers: {"Access-Control-Allow-Origin": "*"},
			type: 'GET',
			//url: "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522,151.1957362&radius=5000&key=AIzaSyAl3D1Rnff8rO5DKIp3YS3w5u2A9F9ZsCA"
			url: "https://maps.googleapis.com/maps/api/place/nearbysearch/json?key=AIzaSyAl3D1Rnff8rO5DKIp3YS3w5u2A9F9ZsCA&location="+this.els.lat.value+","+this.els.lng.value+"&radius=5000"
			//url: "https://maps.googleapis.com/maps/api/geocode/json?address="+this.value+'&key=AIzaSyAl3D1Rnff8rO5DKIp3YS3w5u2A9F9ZsCA'
		}).done(function(response){
			console.log(response);
			if(response.status==="OK"){

			}
		}).fail(function(){

		});
	},
};
