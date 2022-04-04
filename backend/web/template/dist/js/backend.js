if(typeof jQuery === "undefined"){
	throw new Error("Myadmin requires jQuery");
}

$(function(){
	"use strict";

	var BJS = {
		options: {},
		route: {
			backend_url: '/backend/web',
			frontend_url: '',
			forms: {
				remove_image: '/backend/web/%controller%/remove-image/',
			},
			property: {
				prop_cats_fragments: '/backend/web/property/get-cats-fragments/',
				change_active_status: '/backend/web/property/set-status/',
			},
			nearby_places: {
				change_active_status: '/backend/web/nearby-places/set-status/',
			},
			nearby_places_type: {
				change_active_status: '/backend/web/nearby-places-types/set-status/',
			},
			pages: {
				change_active_status: '/backend/web/pages/set-status/',
				change_meta_noindex_status: '/backend/web/pages/set-noindex-status/',
			},
			property_features_types: {
				change_active_status: '/backend/web/property-features-types/set-status/',
			},
			category_city_content: {
				change_active_status: '/backend/web/category-city-content/set-status/',
			},
			users: {
				change_active_status: '/backend/web/users/set-status/',
			},
		},
		els: {
			body: $('body'),
			js_data_loader: $('#js_data_loader'),
			property_category_id: $('#property-category_id'),
			property_categories: $('#property-categories'),
			js_category_city_content_state: $('#js_category_city_content_state'),
		},
		Init: function(){
			this.initEvents();
			this.Properties.Init();
			this.Categories.Init();
			this.Forms.Init();
		},
		initEvents: function(){
			$(document)
				.on('keyup', '[data-trigger="js_action_keyup"]', BJS.doAction)
				.on('focus', '[data-trigger="js_action_focus"]', BJS.doAction)
				.on('blur', '[data-trigger="js_action_blur"]', BJS.doAction)
				.on('change', '[data-trigger="js_action_change"]', BJS.doAction)
				.on('click', '[data-trigger="js_action_click"]', BJS.doAction);
		},
		doAction: function(e){
			e.preventDefault();

			var $this = $(this),
				action = $(this).data('action');

			switch(action){
				case "remove_image":
					BJS.Forms.ajaxRemoveImage($this);
					break;
				case "choose_icon":
					BJS.Properties.actionChooseIcon($this);
					break;
				case "filter_categories":
					BJS.Properties.actionFilterCategories($this);
					break;
				case "ajax_get_prop_cats":
					//BJS.Properties.ajaxGetPropCats($this);
					break;
				case "ajax_change_user_status":
					BJS.Forms.ajaxChangeEntryStatus($this, 'users', 'active');
					break;
				case "ajax_change_3c_status":
					BJS.Forms.ajaxChangeEntryStatus($this, 'category_city_content', 'active');
					break;
				case "ajax_change_prop_status":
					BJS.Forms.ajaxChangeEntryStatus($this, 'property', 'active');
					break;
				case "ajax_change_npt_status":
					BJS.Forms.ajaxChangeEntryStatus($this, 'nearby_places_type', 'active');
					break;
				case "ajax_change_np_status":
					BJS.Forms.ajaxChangeEntryStatus($this, 'nearby_places', 'active');
					break;
				case "ajax_change_page_status":
					BJS.Forms.ajaxChangeEntryStatus($this, 'pages', 'active');
					break;
				case "ajax_change_page_indexing":
					BJS.Forms.ajaxChangeEntryStatus($this, 'pages', 'meta_noindex');
					break;
				case "ajax_change_prop_feature_type_separated":
					BJS.Forms.ajaxChangeEntryStatus($this, 'property_features_types', 'separated');
					break;
				case "toggle_more_location_fields":
					BJS.Properties.toggleMoreLocationFields($this);
					break;
				case "copy_from_field":
					BJS.Forms.copyFromField($this);
					break;
				case "create_slug":
					BJS.Forms.createSlug($this);
					break;
				case "create_slug_n_meta":
					BJS.Forms.createSlug($this);
					BJS.Forms.createMetaTitle($this);
					break;
				case "select_text":
					BJS.Forms.selectText($this);
					break;
				case "toggle_content_editor":
					BJS.Forms.toggleContentEditor($this);
					break;
				case "property_features_search":
					BJS.Properties.searchFeatures($this);
					break;
				case "filter_cities_by_state":
					BJS.Categories.FilterCitiesByState($this);
					break;
				case "category_city_content_custom_validate":
					BJS.Categories.CustomValidate($this);
					break;
			}

		},
		Forms: {
			Init: function(){
				this.initContentEditorDisplay();
			},
			string_to_slug: function(str, separator){
				str = str.trim();
				str = str.toLowerCase();

				// remove accents, swap ñ for n, etc
				const from = "åàáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
				const to = "aaaaaaeeeeiiiioooouuuunc------";

				for (let i = 0, l = from.length; i < l; i++) {
					str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
				}

				return str
					.replace(/[^a-z0-9 -]/g, "") // remove invalid chars
					.replace(/\s+/g, "-") // collapse whitespace and replace by -
					.replace(/-+/g, "-") // collapse dashes
					.replace(/^-+/, "") // trim - from start of text
					.replace(/-+$/, "") // trim - from end of text
					.replace(/-/g, separator);
			},
			copyFromField: function($obj){
				var $source = $($obj.data('source'));

				if($source.length && $obj.val() == ''){
					$obj.val($source.val());
				}

			},
			createSlug: function($obj){
				var targets = $obj.data('target'),
					$target = null,
					$source = $($obj.data('source')),
					val = '',
					slug = '';

				if($source.length){
					val = $source.val();
					slug = BJS.Forms.string_to_slug(val, '-');
					if($obj.val() == ''){
						$obj.val(slug);
					}
				}

				if(targets != undefined){
					targets = targets.split(',');

					for(var i = 0; i <= targets.length; i++){
						$target = $(targets[i]);

						if($target.length){
							val = $obj.val();
							slug = BJS.Forms.string_to_slug(val, '-');
							if($target.val() == ''){
								$target.val(slug);
							}
						}
					}
				}
			},
			createMetaTitle: function($obj){
				var $target = $($obj.data('target2')),
					val = $obj.val();

				if($target.val() == ''){
					$target.val(val);
				}
			},
			selectText: function($obj){
				$obj.select();
			},
			ajaxChangeEntryStatus: function($obj, type, field){
				var checked = $obj.is(':checked'),
					id = $obj.val(),
					data = {};

				data[field] = checked;

				BJS.els.js_data_loader.addClass('show');

				$.ajax({
					type: "POST",
					url: BJS.route[type]["change_"+field+"_status"] + id,
					data: data,
					dataType: "json"
				}).done(function(responce){
					if(responce.error == 0){

					}
					BJS.els.js_data_loader.removeClass('show');
				}).fail(function(){
					BJS.els.js_data_loader.removeClass('show');
					console.log("SYSTEM TECHNICAL ERROR");
				});
			},
			ajaxRemoveImage: function($obj){
				var $loader_tag = $obj.find('i');
				var $parent = $obj.parents('li');
				var post_data = {
					"id": $obj.data("id"),
					"field": $obj.data("field"),
					"file": $obj.data("file"),
					"controller": $obj.data("controller"),
				};
				//console.log(post_data);

				$loader_tag.addClass('fa-spinner fa-spin').removeClass('fa-times');

				$.ajax({
					type: "POST",
					url: BJS.route.forms.remove_image.replace('%controller%', post_data.controller) + post_data.id,
					data: {'data': post_data},
					dataType: "json"
				}).done(function(responce){
					if(responce.error == 0){
						$parent.remove();
					}
				}).fail(function(){
					$loader_tag.removeClass('fa-spinner').addClass('fa-times');
					console.log("SYSTEM TECHNICAL ERROR");
				});
			},
			toggleContentEditor: function($obj){
				var val = $obj.val(),
					$target = $($obj.data('target'));

				if(val == ''){
					$target.show();
				}else{
					$target.hide();
				}
			},
			initContentEditorDisplay: function(){
				BJS.Forms.toggleContentEditor($('#pages-template'));
			},
		},
		Properties: {
			Init: function(){
				if(BJS.els.property_category_id.length){
					//BJS.Properties.actionFilterCategories(BJS.els.property_category_id);
				}
			},
			/** Method ajaxGetPropCats not used **/
			ajaxGetPropCats: function($obj){
				var post_data = {
					"id": $obj.data("property_id"),
					"type": $obj.val(),
				};
				//console.log(post_data);

				BJS.els.js_data_loader.addClass('show');

				$.ajax({
					type: "POST",
					url: BJS.route.property.prop_cats_fragments + post_data.id,
					data: {'data': post_data},
					dataType: "json"
				}).done(function(responce){
					if(responce.error == 0){
						BJS.els.property_category_id.html(responce.category_ids);
						BJS.els.property_categories.html(responce.categories);
						BJS.Properties.actionFilterCategories(BJS.els.property_category_id);
					}
					BJS.els.js_data_loader.removeClass('show');
				}).fail(function(){
					BJS.els.js_data_loader.removeClass('show');
					console.log("SYSTEM TECHNICAL ERROR");
				});
			},
			actionChooseIcon: function($obj){
				var $target = $($obj.data('target')),
					value = $obj.data('icon'),
					$modal = $($obj.parents('.modal'));

				$target.val(value);
				$modal.find('[data-dismiss="modal"]').trigger('click');
			},
			actionFilterCategories: function($obj){
				var value = $obj.val();

				BJS.els.property_categories
					.find('.check-item').removeClass('hidden')
					.end()
					.find('.check-item[data-id="'+value+'"').addClass('hidden');
			},
			toggleMoreLocationFields: function($obj){
				var $target = $($obj.data('target'));
				$target.toggleClass('show');
			},
			searchFeatures: function($input){
				// Declare variables
				var filter, ul, li, a, i, txtValue;
				filter = $input.val().toUpperCase();
				console.log(filter);
				ul = document.getElementById("property-features");
				li = ul.getElementsByTagName('div');

				// Loop through all list items, and hide those who don't match the search query
				for (i = 0; i < li.length; i++) {
					a = li[i].getElementsByTagName("label")[0];
					txtValue = a.textContent || a.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						li[i].style.display = "";
					} else {
						li[i].style.display = "none";
					}
				}
			},
		},
		Categories: {
			Init: function(){
				if(BJS.els.js_category_city_content_state.length){
					BJS.els.js_category_city_content_state.trigger('change');
				}
			},
			FilterCitiesByState: function($obj){
				var state_id = $obj.val(),
					$target = $($obj.data('target'));

				$target.find('option:not(.empty-value)').addClass('hidden');
				$target.find('option[data-state_id="'+state_id+'"]').removeClass('hidden');
			},
			CustomValidate: function($obj){
				return false;
			},
		},
	};

	BJS.Init();
});
