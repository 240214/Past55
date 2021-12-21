if(typeof jQuery === "undefined"){
	throw new Error("Frontend requires jQuery");
}

$(function(){
	"use strict";

	var FJS = {
		options: {
			slick_options: {
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: true,
				fade: true,
				//adaptiveHeight: true,
				asNavFor: '.slider-nav'
			},
			slick_nav_options: {
				slidesToShow: 4,
				slidesToScroll: 1,
				vertical: true,
				asNavFor: '.slider-for',
				dots: false,
				arrows: false,
				focusOnSelect: true,
				verticalSwiping: true,
				centerMode: false,
				responsive: [
					{breakpoint: 1400, settings: {slidesToShow: 3}},
					{breakpoint: 992, settings: {vertical: false, slidesToShow: 4}},
					{breakpoint: 840, settings: {vertical: false, slidesToShow: 3}},
					{breakpoint: 768, settings: {vertical: false}},
					{breakpoint: 580, settings: {vertical: false, slidesToShow: 3}},
				]
			}
		},
		vars: {
			ww: 0,
			wh: 0,
			scrollTop: 0,
			scrollTopPrev: 0,
			scroll_dir: 'bottom',
			nav_tabs: {
				fitting: false,
				items: {},
			},
			csrf_param: null,
			csrf_token: null,
			max_compare_items: 3,
			modal: null,
			tooltip: null,
			lazyLoadInstance: null,
		},
		labels: {
			show_more: 'Show more',
			show_less: 'Show less',
			add_to_fav: 'Add to Favorite',
			rem_from_fav: 'Remove from Favorite',
		},
		messages: {
			ajax_error: 'SYSTEM TECHNICAL ERROR'
		},
		routes: {
			backend_url: '/backend/web',
			frontend_url: '',
			property: {
				search: '/property/search/',
				filter: '/property/filter/',
				compare: '/compare/',
			},
			customer: {
				address_store: '/customer/address-store/',
				address_remove: '/customer/address-remove/',
				address_load: '/customer/address-load/',
				favorite_toggle: '/favorites/property/',
			},
			compare: {
				get_property: '/compare/get-property/',
			},
		},
		els: {
			body: $("body"),
			js_loader: $(".js_data_loader"),
			js_h1: $("h1"),
			js_breadcrumbs: $("#js_breadcrumbs"),
			js_filter_pagination: $("#js_filter_pagination"),
			js_filter_results: $("#js_filter_results"),
			js_filter_form: $("#js_filter_form"),
			js_filter_bar: $("#js_filter_bar"),
			js_result_count_label: $(".js_result_count_label"),
			js_nav_tabs: $(".js_nav_tabs"),
			js_backdrop: $("#js_backdrop"),
			js_compare_panel: $('#js_compare_panel'),
			js_favorite_items: $('#js_favorite_items'),
			js_user_favs_count: $('.js_user_favs_count'),
			js_add_to_favs_btn: $('#js_add_to_favs_btn'),
			js_narrow_cities_widget: $('#js_narrow_cities_widget'),
			js_nearby_cities_widget: $('#js_nearby_cities_widget'),
		},
		Init: function(){
			this.vars.ww = $(window).width();
			this.vars.wh = $(window).height();
			this.vars.csrf_param = $('meta[name="csrf-param"]').attr('content');
			this.vars.csrf_token = $('meta[name="csrf-token"]').attr('content');

			this.Core.initEvents();
			this.Common.initLazyLoad();
			this.Common.initSlickCarousel();
			this.Common.initTooltip();
			//this.Common.initSocialShare();
			this.NavTabs.init();
			this.Comparison.initTypeOfPlaces();
			this.Comparison.setBlocksEqualHeigth(false);
			this.Comparison.init();
			this.Share.init();
			//this.Common.initFloatFavButtonTooltip();
		},
		Core: {
			initEvents: function(){
				$(window)
				//.on('scroll', FJS.eventScrollWindow)
					.on('resize orientationchange deviceorientation', FJS.Core.eventResizeWindow);

				$(document)
					.on('blur', '[data-trigger="js_action_blur"]', FJS.Core.doAction)
					.on('change', '[data-trigger="js_action_change"]', FJS.Core.doAction)
					.on('click', '[data-trigger="js_action_click"]', FJS.Core.doAction)
					.on('submit', '[data-trigger="js_action_submit"]', FJS.Core.doAction);
			},
			eventResizeWindow: function(){
				FJS.vars.ww = $(window).width();
				FJS.vars.wh = $(window).height();

				FJS.NavTabs.fit();
				if(FJS.vars.ww > 767){
					FJS.Comparison.setBlocksEqualHeigth(true);
				}
			},
			eventScrollWindow: function(){
				FJS.vars.scrollTop = $(window).scrollTop();
				if(FJS.vars.scrollTopPrev > 0){
					if(FJS.vars.scrollTop > FJS.vars.scrollTopPrev){
						FJS.vars.scroll_dir = 'bottom';
					}else{
						FJS.vars.scroll_dir = 'top';
					}
				}
				FJS.vars.scrollTopPrev = FJS.vars.scrollTop;

				FJS.Common.toggleFloatFavButton();
			},
			doAction: function(e){
				var $this = $(this),
					action = $(this).data('action');

				switch(action){
					case "property_filter":
						FJS.Properties.Filter(e, $this);
						break;
					case "toggle_filter_sidebar":
						FJS.Properties.ToggleFilterBar($this);
						break;
					case "nav_tab_dd_item_select":
						FJS.NavTabs.select($this);
						break;
					case "add_customer_address":
						FJS.Customer.AddressAdd($this);
						break;
					case "remove_customer_address":
						FJS.Customer.AddressRemove($this);
						break;
					case "store_customer_address":
						FJS.Customer.AddressStore($this);
						break;
					case "property_toggle_favorite":
						FJS.Customer.PropertyToggleFavotite($this);
						break;
					case "print":
						window.print();
						break;
					case "share":
						FJS.Share.run();
						break;
					case "toggle_mobile_nav":
						FJS.Common.toggleMobileNav($this);
						break;
					case "add_to_compare":
						FJS.Properties.ToggleCompareItems($this);
						break;
					case "remove_compare_item":
						FJS.Properties.RemoveCompareItem($this);
						break;
					case "toggle_features_view":
						FJS.Properties.toggleFeaturesView($this);
						break;
					case "compare_items":
						FJS.Comparison.CompareItems($this);
						break;
					case "type_of_place_change":
						FJS.Comparison.changeTypeOfPlace($this);
						break;
					case "store_customer_address_to_compare_list":
						FJS.Comparison.StoreAddressToList($this);
						break;
					case "open_add_address_modal":
						FJS.Comparison.OpenModal($this);
						break;
					case "load_compare_property_item":
						FJS.Comparison.LoadCompareProperty($this);
						break;
					case "remove_customer_address_from_compare":
						FJS.Comparison.RemoveCustomerAddress($this);
						break;
					default:
						break;
				}

				e.preventDefault();
			},
		},
		Loader: {
			start: function(){
				FJS.els.js_loader.addClass('show');
			},
			stop: function(){
				FJS.els.js_loader.removeClass('show');
			},
		},
		Common: {
			setLocation: function(url){
				try {
					history.pushState(null, null, url);
					return;
				} catch(e) {}
				//location.hash = '#' + curLoc;
			},
			getSessionStorage: function(key){
				return sessionStorage.getItem(key);
			},
			setSessionStorage: function(key, value){
				sessionStorage.setItem(key, value);
			},
			initLazyLoad: function(){
				if(FJS.vars.lazyLoadInstance != null){
					FJS.vars.lazyLoadInstance.update();
				}else{
					if($('img.lazy').length){
						FJS.vars.lazyLoadInstance = new LazyLoad({
							elements_selector: ".lazy",
							//load_delay: 300,
							threshold: 0,
							callback_finish: function(instance){
								//console.log("Finish");
								//console.log(instance);
								var fit_image_block = (FJS.vars.ww > 767 ? true : false);
								console.log(fit_image_block);
								FJS.Comparison.setBlocksEqualHeigth(fit_image_block);
							}
						});
					}
				}
			},
			initSlickCarousel: function(){
				if($('.slider.slider-for').length){
					$('.slider.slider-for').slick(FJS.options.slick_options);
				}
				if($('.slider.slider-nav').length){
					$('.slider.slider-nav').slick(FJS.options.slick_nav_options);
				}
			},
			initTooltip: function(){
				if($('[data-bs-toggle="tooltip"]').length){
					var tooltipTriggerList = [].slice.call($('[data-bs-toggle="tooltip"]'));
					var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
						return new bootstrap.Tooltip(tooltipTriggerEl, {'html': true, 'customClass': 'np-tooltip'});
					})
				}
			},
			initSocialShare: function(){
				if($(".js_social_share").length){
					$(".js_social_share > div").jsSocials({
						shares: [
							{share: "facebook", label: "", logo: "zmdi zmdi-facebook", shareIn: "blank", css: "rmds-item mdc-bg-indigo-400 animated bounceIn"},
							{share: "twitter", label: "", logo: "zmdi zmdi-twitter", shareIn: "blank", css: "rmds-item mdc-bg-cyan-500 animated bounceIn"},
							{share: "googleplus", label: "", logo: "zmdi zmdi-google", shareIn: "blank", css: "rmds-item mdc-bg-red-400 animated bounceIn"},
							{share: "linkedin", label: "", logo: "zmdi zmdi-linkedin", shareIn: "blank", css: "rmds-item mdc-bg-blue-600 animated bounceIn"}
						]
					});
				}
			},
			toggleMobileNav: function($obj){
				var target = $obj.data("target");

				if(FJS.els.body.hasClass("block-opened")){
					FJS.els.body.removeClass("block-opened");
					$(target).removeClass("toggled");
					FJS.els.js_backdrop.data('action', '').data('target', '').fadeOut(300);
				}else{
					FJS.els.body.addClass("block-opened");
					$(target).addClass("toggled");
					FJS.els.js_backdrop.data('action', 'toggle_mobile_nav').data('target', target).fadeIn(300);
				}
			},
			OpenModal: function(target){
				FJS.vars.modal = new bootstrap.Modal(document.getElementById(target), {keyboard: false});
				FJS.vars.modal.show();
			},
			initFloatFavButtonTooltip: function(){
				if(FJS.els.js_add_to_favs_btn.length){
					if(!FJS.els.js_add_to_favs_btn.find('.js_trigger').hasClass('checked')){
						var id = FJS.els.js_add_to_favs_btn.attr('id');
						FJS.vars.tooltip = new bootstrap.Tooltip(document.getElementById(id), {
							title: FJS.els.js_add_to_favs_btn.attr('title')
						});
						setTimeout(function(){
							FJS.vars.tooltip.show();
							setTimeout(function(){
								FJS.vars.tooltip.hide();
								FJS.vars.tooltip.dispose();
							}, 10000);
						}, 1000);
					}
				}
			},
			toggleFloatFavButton: function(){
				if(FJS.els.js_add_to_favs_btn.length){
					if(FJS.vars.scroll_dir == 'bottom'){
						FJS.els.js_add_to_favs_btn.removeClass('view');
					}
					if(FJS.vars.scroll_dir == 'top'){
						FJS.els.js_add_to_favs_btn.addClass('view');
					}
				}
			},
		},
		Share: {
			vars: {
				enabled: true,
			},
			init: function(){
				if(navigator.share === undefined){
					FJS.Share.vars.enabled = false;
					$('[data-action="share"]').prop('disabled', true).addClass('hide');

					if(window.location.protocol === 'http:'){
						// navigator.share() is only available in secure contexts.
						window.location.replace(window.location.href.replace(/^http:/, 'https:'));
					}else{
						//console.error('Error: You need to use a browser that supports this draft proposal.');
					}
				}
			},
			run: async function(){
				if(FJS.Share.vars.enabled){
					var url = document.location.href,
						title = $('title').text(),
						$canonicalElement = $('meta[rel="canonical"]');

					if($canonicalElement.length){
						url = $canonicalElement.attr('href');
					}
					try{
						await navigator.share({title: title, url: url});
						console.log("Data was shared successfully");
					}catch(err){
						console.error("Share failed:", err.message);
					}
				}else{
					console.error("Error: Your browser not supports share.");
				}
			},
		},
		NavTabs: {
			init: function(){
				if(FJS.els.js_nav_tabs.length){
					FJS.vars.nav_tabs.fitting = true;

					FJS.els.js_nav_tabs.find('.nav-item:not(.dropdown)').each(function(i, el){
						var w = $(this).width(),
							id = $(this).data('id');

						if(w > 0)
							FJS.vars.nav_tabs.items[id] = w;
					});

					//console.log(FJS.vars.nav_tabs.items);
					FJS.NavTabs.fit();
				}
			},
			fit: function(){
				//console.log(FJS.vars.nav_tabs.fitting);
				if(FJS.vars.nav_tabs.fitting){
					var items_w = 0,
						d_item_w = FJS.els.js_nav_tabs.find('.nav-item.dropdown').width(),
						js_nav_tabs_w = FJS.els.js_nav_tabs.width(),
						hide_more = true;

					$.each(FJS.vars.nav_tabs.items, function(id, width){
						items_w += width;

						if(items_w < js_nav_tabs_w - d_item_w){
							FJS.els.js_nav_tabs.find('.nav-item[data-id="'+id+'"]').removeClass('d-none');
							FJS.els.js_nav_tabs.find('.nav-item[data-id="clone-'+id+'"]').addClass('d-none');
						}else{
							hide_more = false;
							FJS.els.js_nav_tabs.find('.nav-item[data-id="'+id+'"]').addClass('d-none');
							FJS.els.js_nav_tabs.find('.nav-item[data-id="clone-'+id+'"]').removeClass('d-none');
						}
					});

					if(hide_more){
						FJS.els.js_nav_tabs.find('.nav-item.dropdown').addClass('d-none');
					}else{
						FJS.els.js_nav_tabs.find('.nav-item.dropdown').removeClass('d-none');
					}
				}
			},
			select: function($obj){
				FJS.els.js_nav_tabs.find('.nav-link').removeClass('active');
				$obj.addClass('active');
			},
		},
		Properties: {
			Filter: function(e, $btn){
				e.stopPropagation();

				FJS.Loader.start();

				var ids = [],
					sorting = 0,//FJS.els.sorting.val(),
					data = FJS.els.js_filter_form.serializeArray();

				FJS.els.js_filter_results.find('.box').each(function(){
					ids.push($(this).data('id'));
				});

				data.push({'name': 'Property[sort]', 'value': sorting});
				data.push({'name': 'Property[ids]', 'value': ids});

				if($btn){
					if($btn.attr('id') == 'js_filter_form'){
						if(FJS.vars.ww < 768){
							FJS.Properties.ToggleFilterBar();
						}
					}
				}

				$.ajax({
					type: 'post',
					url: FJS.routes.property.filter,
					data: data,
					format: 'json'
				}).done(function(responce){
					if(!responce.error){
						var $content = null;
						if(responce.count){
							FJS.els.js_filter_results.removeClass('no-results');
							$content = responce.html.items;
						}else{
							var $h3 = $('<h3>');
							$h3.html(responce.not_found_label);
							$content = $('<div>');
							$content.addClass('card box').html($h3);
							FJS.els.js_filter_results.addClass('no-results');
						}
						FJS.els.js_result_count_label.html(responce.found_label);
						//FJS.els.btn_toggle_filter.find('span').html(responce.count);
						FJS.Common.setLocation(responce.url);
						FJS.els.js_h1.html(responce.title);
						FJS.els.js_breadcrumbs.html(responce.breadcrumbs);
						FJS.els.js_filter_results.html($content);
						FJS.els.js_filter_pagination.html(responce.html.pagination);

						if(FJS.els.js_narrow_cities_widget.length){
							if(responce.html.narrow_cities == ''){
								FJS.els.js_narrow_cities_widget.addClass('hide');
							}else{
								FJS.els.js_narrow_cities_widget.removeClass('hide');
							}
							FJS.els.js_narrow_cities_widget.html(responce.html.narrow_cities);
						}

						if(FJS.els.js_nearby_cities_widget.length){
							if(responce.html.nearby_cities == ''){
								FJS.els.js_nearby_cities_widget.addClass('hide');
							}else{
								FJS.els.js_nearby_cities_widget.removeClass('hide');
							}
							FJS.els.js_nearby_cities_widget.html(responce.html.nearby_cities);
						}

						FJS.Common.initLazyLoad();
					}else{
						console.log(responce);
					}
					FJS.Loader.stop();
				}).fail(function(){
					FJS.Loader.stop();
				});

				return false;

			},
			ToggleFilterBar: function($btn){
				FJS.els.js_filter_bar.toggleClass('open');
				FJS.els.body.toggleClass('filter-opened');
			},
			ToggleCompareItems: function(){
				var $compare_items = FJS.els.js_compare_panel.find('#js_compare_items');
				var $btn_compare = FJS.els.js_compare_panel.find('#js_btn_compare');

				$compare_items.html('');

				FJS.els.js_favorite_items.find('input[name="add_to_compare"]:checked').each(function(i, el){
					var _this = $(this);
					if(i < FJS.vars.max_compare_items){
						var $div = $('<div>'),
							$figure = $('<figure>'),
							$image = _this.parents('.box').find('img').clone(),
							$close = $('<a>'),
							$text = $('<div>'),
							$strong = $('<strong>');

						$div
							.data('parent', _this.attr('id'))
							.data('item', _this.data('id'))
							.data('name', _this.data('slug'))
							.addClass('item list-group-item d-flex flex-row align-items-center');
						$close
							.addClass('close-btn')
							.attr('role', 'button')
							.attr('data-trigger', 'js_action_click')
							.attr('data-action', 'remove_compare_item')
							.append('<i class="zmdi zmdi-close-circle"></i>');

						$image.removeClass('hidden-xs');
						$figure.addClass('image empty-bg').append($image);

						$strong.addClass('mb-2').html(_this.parents('.box').find('h2').find('a').clone());
						$text.addClass('text').append($strong).append(_this.parents('.box').find('small').clone());

						$div.append($close);
						$div.append($figure);
						$div.append($text);

						$compare_items.prepend($div);
					}
				});

				FJS.Common.initLazyLoad();

				var cl = FJS.els.js_favorite_items.find('input[name="add_to_compare"]:checked').length;

				if(cl == FJS.vars.max_compare_items){
					FJS.els.js_favorite_items.find('input[name="add_to_compare"]:not(:checked)').prop('disabled', true);
				}else{
					FJS.els.js_favorite_items.find('input[name="add_to_compare"]:not(:checked)').prop('disabled', false);
				}

				FJS.els.js_compare_panel.removeAttr('style');

				if(cl > 1){
					$btn_compare.prop('disabled', false);
				}else if(cl == 1){
					$btn_compare.prop('disabled', true);
				}else if(cl <=0){

				}

			},
			RemoveCompareItem: function($obj){
				var id = $obj.parent('div').data('parent');

				console.log(id);

				$('#'+id).prop('checked', false);

				FJS.Properties.ToggleCompareItems();
			},
			toggleFeaturesView: function($obj){
				var $parent = $obj.parent('.group');
				$parent.toggleClass('less');

				if($parent.hasClass('less')){
					$obj.text(FJS.labels.show_more);
				}else{
					$obj.text(FJS.labels.show_less);
				}
			},
		},
		Customer: {
			AddressStore: function($btn){
				FJS.Loader.start();

				var $form = $btn.parents('form'),
					data = $form.serializeArray();

				$.ajax({
					type: 'post',
					url: FJS.routes.customer.address_store,
					data: data,
					format: 'json'
				}).done(function(responce){
					if(!responce.error){
						$form.find('.js_customer_address_id').each(function(i, el){
							$(el).val(responce.ids[i]);
						});
					}else{
						console.log(responce);
					}
					FJS.Loader.stop();
				}).fail(function(responce){
					console.log(responce.responseJSON.code, responce.responseJSON.name);
					FJS.Loader.stop();
				});

				return false;
			},
			AddressRemove: function($btn){
				FJS.Loader.start();

				var $form = $btn.parents('form'),
					$row = $btn.parents('.js_customer_address_row'),
					address_count = $form.find('.js_customer_address_row').length,
					data = {'id': ~~$row.find('.js_customer_address_id').val()};

				data[FJS.vars.csrf_param] = FJS.vars.csrf_token;

				console.log(data.id);

				if(data.id > 0){
					$.ajax({
						type: 'post',
						url: FJS.routes.customer.address_remove,
						data: data,
						format: 'json'
					}).done(function(responce){
						if(!responce.error){
							if(address_count > 1){
								$row.remove();
							}else{
								$row.find('input').val('').end().find('.js_customer_distance_label').text('');
							}
						}else{
							console.log(responce);
						}
						FJS.Loader.stop();
					}).fail(function(){
						FJS.Loader.stop();
					});
				}else{
					if(address_count > 1){
						$row.remove();
					}else{
						$row.find('input').val('').end().find('.js_customer_distance_label').text('');
					}
					FJS.Loader.stop();
				}
			},
			AddressAdd: function($btn){
				var $form = $btn.parents('form'),
					$last_address_row = $form.find('.js_customer_address_row:last'),
					$clone = $last_address_row.clone(false);
				$clone
					.find('input').val('')
					.end()
					.find('.js_customer_distance_label').text('');

				$last_address_row.after($clone);
				MapJS.initAutocomplete();
			},
			PropertyToggleFavotite: function($btn){
				FJS.Loader.start();

				var data = {'property_id' : $btn.data('property_id')};
				data[FJS.vars.csrf_param] = FJS.vars.csrf_token;

				$.ajax({
					type: 'post',
					url: FJS.routes.customer.favorite_toggle,
					data: data,
					format: 'json'
				}).done(function(responce){
					if(!responce.error){
						var $container = $('.js_property_likes[data-id="'+data.property_id+'"]');
						if(responce.result.checked == 1){
							$container.find('.js_trigger')
								.prop('checked', true)
								.addClass('checked')
								.attr('title', FJS.labels.rem_from_fav)
								.attr('data-bs-original-title', FJS.labels.rem_from_fav);
						}else{
							$container.find('.js_trigger')
								.prop('checked', false)
								.removeClass('checked')
								.attr('title', FJS.labels.add_to_fav)
								.attr('data-bs-original-title', FJS.labels.add_to_fav);
						}
						$container.find('.count').text(responce.result.count);
						FJS.Customer.setUserFavsCount(responce.result.user_favs_count);
					}else{
						console.log(responce);
					}
					FJS.Loader.stop();
				}).fail(function(responce){
					console.log(FJS.messages.ajax_error);
					FJS.Loader.stop();
				});

				return false;
			},
			setUserFavsCount: function(count){
				FJS.els.js_user_favs_count.text(count);
			},
		},
		Comparison: {
			vars: {
				groupped_duplcate_features: false,
				groupped_duplcate_categories: false,
			},
			init: function(){
				var props_ids = [];

				if($('.js_user_favorites').length){
					$('.js_user_favorites select option[selected="selected"]').attr('selected', false);

					$('.js_user_favorites').each(function(i, el){
						var id = ~~$(el).data('property_id');
						props_ids.push(id);
						$(el).find('select').val(id).find('option[value="'+id+'"]').attr('selected', true);
					});

					$.each(props_ids, function(i, id){
						$('.js_user_favorites select option[value="'+id+'"]').addClass('hide');
					});
					$('.js_user_favorites select option[selected="selected"]').removeClass('hide');
				}
			},
			CompareItems: function($obj){
				var ids = [];
				var ids2 = [];
				var names = [];
				var url = FJS.routes.property.compare + '';
				var origin = window.location.origin;
				var $compare_items = FJS.els.js_compare_panel.find('#js_compare_items');

				$compare_items.find('.item').each(function(i, el){
					ids2.push($(el).data('item'));
					names.push($(el).data('name'));
				});

				//console.log(names);

				//url = url + ids2.join(':');
				url = url + names.join('-vs-');

				url = origin + url;

				/*FJS.els.filter_results.find('.box').each(function(){
					ids.push($(this).data('id'));
				});*/

				//FJS.setSessionStorage(FJS.options.filtered_items_count_key, ids.length);

				window.location.href = url;

				//console.log(url);
			},
			initTypeOfPlaces: function(){
				var flag = false;
				if($('.js_type_of_place').length){
					$('.js_type_of_place').each(function(i, el){
						if($(el).val() != 'n_a' && !flag){
							$(el).trigger('change');
							flag = true;
						}
					});
				}
			},
			changeTypeOfPlace: function($obj){
				var val = $obj.val(),
					h = 0;

				$('.js_type_of_place').each(function(i, el){
					if($(el).attr('id') != $obj.attr('id')){
						if($(el).find('option[value="'+val+'"]').length){
							$(el).val(val).parents('.nearby-places')
								.find('table tbody tr').addClass('hide')
								.end()
								.find('tr[data-group="'+val+'"]').removeClass('hide');
						}else{
							if($(el).find('option[value="n_a"]').length == 0){
								$(el).append('<option value="n_a">N/A</option>');
							}
							$(el).val('n_a').parents('.nearby-places')
								.find('table tbody tr').addClass('hide')
								.end()
								.find('tr[data-group="n_a"]').removeClass('hide');
						}
					}else{
						$obj.parents('.nearby-places')
							.find('table tbody tr').addClass('hide')
							.end()
							.find('tr[data-group="'+val+'"]').removeClass('hide');
					}
				});

				FJS.Comparison.setBlocksEqualHeigth(false);

				/*$('.js_np_data_table')
					.removeAttr('style')
					.each(function(i, el){
						if(h < $(el).height()){
							h = $(el).height();
						}
					})
					.height(h);*/
			},
			setBlocksEqualHeigth: function(image_block){
				if($('.compare-index').length){

					FJS.Comparison.groupDuplcateFeatures();
					FJS.Comparison.groupDuplcateCategories();

					var h = 0;

					$('.js_np_data_table').removeAttr('style').each(function(i, el){
						if(h < $(el).height()){
							h = $(el).height();
						}
					}).height(h);

					h = 0;
					$('.js_c_data_table').removeAttr('style').each(function(i, el){
						if(h < $(el).height()){
							h = $(el).height();
						}
					}).height(h);

					h = 0;
					$('.js_f_data_table').removeAttr('style').each(function(i, el){
						if(h < $(el).height()){
							h = $(el).height();
						}
					}).height(h);

					h = 0;
					$('.title').removeAttr('style').each(function(i, el){
						if(h < $(el).height()){
							h = $(el).height();
						}
					}).height(h);

					h = 0;
					$('.address').removeAttr('style').each(function(i, el){
						if(h < $(el).height()){
							h = $(el).height();
						}
					}).height(h);

					if(image_block){
						h = 99999;
						$('.js_item_image').removeAttr('style').each(function(i, el){
							if(h > $(el).height()){
								h = $(el).height();
							}
						}).height(h);
					}
				}
			},
			StoreAddressToList: function($btn){
				FJS.Loader.start();

				var $form = $btn.parents('form'),
					data = $form.serializeArray();
				console.log(data);

				$.ajax({
					type: 'post',
					url: FJS.routes.customer.address_store,
					data: data,
					format: 'json'
				}).done(function(responce){
					if(!responce.error){
						$form.find('input[type="text"]').each(function(i, el){
							$(el).val('');
						});
						FJS.Comparison.LoadCustomerAddress(responce.ids[0]);
						FJS.vars.modal.hide();
					}else{
						console.log(responce);
					}
					FJS.Loader.stop();
				}).fail(function(responce){
					console.log(responce.responseJSON.code, responce.responseJSON.name);
					FJS.Loader.stop();
				});

				return false;
			},
			LoadCustomerAddress: function(address_id){
				var props_ids = [];

				$('#js_compare_items').find('.compare-item').each(function(i, el){
					props_ids.push($(el).data('id'));
				});

				var data = {
					'address_id': address_id,
					'props_ids': props_ids,
				};
				data[FJS.vars.csrf_param] = FJS.vars.csrf_token;

				$.ajax({
					type: 'post',
					url: FJS.routes.customer.address_load,
					data: data,
					format: 'json'
				}).done(function(responce){
					if(!responce.error){
						$.each(responce.data, function(i, n){
							$('.compare-item[data-id="'+n.id+'"]')
								.find('.distance-to-relatives table tbody')
								.append('<tr data-address_id="'+n.address_id+'"><td>'+n.title+'</td><td>&thickapprox;'+n.distance+' '+n.distance_type+'</td><td><a role="button" data-trigger="js_action_click" data-action="remove_customer_address_from_compare" class="btn-remove-current-address"><i class="zmdi zmdi-close-circle"></i></a></td></tr>');
						});
					}else{
						console.log(responce);
					}
					FJS.Loader.stop();
				}).fail(function(responce){
					console.log(responce.responseJSON.code, responce.responseJSON.name);
					FJS.Loader.stop();
				});

			},
			RemoveCustomerAddress: function($btn){
				FJS.Loader.start();

				var $row = $btn.parents('tr'),
					data = {'id': ~~$row.data('address_id')};

				data[FJS.vars.csrf_param] = FJS.vars.csrf_token;

				console.log(data.id);

				if(data.id > 0){
					$.ajax({
						type: 'post',
						url: FJS.routes.customer.address_remove,
						data: data,
						format: 'json'
					}).done(function(responce){
						if(!responce.error){
							$('tr[data-address_id="'+responce.id+'"]').remove();
						}else{
							console.log(responce);
						}
						FJS.Loader.stop();
					}).fail(function(){
						FJS.Loader.stop();
					});
				}else{
					FJS.Loader.stop();
				}
			},
			OpenModal: function($obj){
				var target = $obj.data('target');
				FJS.Common.OpenModal(target);
				$('#'+target)
					.find('.js_customer_address_lat').val('')
					.end()
					.find('.js_customer_address_lng').val('');
			},
			LoadCompareProperty: function($obj){
				var $container = $obj.parent('.js_user_favorites').siblings('.compare-item'),
					container_id = $container.data('id'),
					property_id = $obj.val();

				if(container_id == property_id || property_id == ''){
					return;
				}

				var data = {'property_id': property_id};
				data[FJS.vars.csrf_param] = FJS.vars.csrf_token;

				$.ajax({
					type: 'post',
					url: FJS.routes.compare.get_property,
					data: data,
					format: 'json'
				}).done(function(responce){
					if(!responce.error){
						$container.html(responce.html).data('id', property_id).siblings('.js_user_favorites').data('property_id', property_id);
						FJS.Common.initLazyLoad();
						FJS.Comparison.vars.groupped_duplcate_features = false;
						FJS.Comparison.vars.groupped_duplcate_categories = false;
						FJS.Comparison.setBlocksEqualHeigth(false);
						FJS.Comparison.init();
					}else{
						console.log(responce);
					}
					FJS.Loader.stop();
				}).fail(function(responce){
					console.log(responce.responseJSON.code, responce.responseJSON.name);
					FJS.Loader.stop();
				});

			},
			groupDuplcateFeatures: function(){
				if(FJS.Comparison.vars.groupped_duplcate_features){
					return;
				}

				var tmp_arr = [];

				$('.js_f_data_table').find('.item').addClass('active');

				$('.js_f_data_table').each(function(i, $group){
					$($group).find('.item').each(function(n, $item){
						var id = $($item).data('feature_id');
						if($.inArray(id, tmp_arr) != -1){
							$('.js_f_data_table').find('[data-feature_id="'+id+'"]').removeClass('active');
						}
						tmp_arr.push(id);
					});
				});

				$('.js_f_data_table').each(function(i, $group){
					var $first_el = null;

					$($group).find('.item').each(function(n, $item){
						if(n == 0) $first_el = $($item);

						if($($item).hasClass('active')){
							if($first_el != null){
								$($item).insertBefore($first_el);
							}
						}
					});
				});

				FJS.Comparison.vars.groupped_duplcate_features = true;
			},
			groupDuplcateCategories: function(){
				if(FJS.Comparison.vars.groupped_duplcate_categories){
					return;
				}

				var tmp_arr = [];

				$('.js_c_data_table').find('.item').addClass('active');

				$('.js_c_data_table').each(function(i, $group){
					$($group).find('.item').each(function(n, $item){
						var id = $($item).data('category_id');
						if($.inArray(id, tmp_arr) != -1){
							$('.js_c_data_table').find('[data-category_id="'+id+'"]').removeClass('active');
						}
						tmp_arr.push(id);
					});
				});

				$('.js_c_data_table').each(function(i, $group){
					var $first_el = null;

					$($group).find('.item').each(function(n, $item){
						if(n == 0) $first_el = $($item);

						if($($item).hasClass('active')){
							if($first_el != null){
								$($item).insertBefore($first_el);
							}
						}
					});
				});

				FJS.Comparison.vars.groupped_duplcate_categories = true;
			},
		},
	};

	FJS.Init();
});
