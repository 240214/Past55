<?php
use yii\helpers\VarDumper;
use yii\widgets\LinkPager;
use yii\bootstrap\Html;

#VarDumper::dump($model, 10, 1);
?>

<section class="section page-content properties-index">
	<div class="loader trans_me"></div>
	<div class="container-lg">
		<header class="section__title text-center text-md-start">
			<h1>My Favorites</h1>
			<small>Vestibulum id ligula porta felis euismod semper</small>
		</header>
		
		<div class="mob-filter-wrap d-block d-md-none">
			<a role="button" class="btn-toggle-filter btn btn-warning" data-trigger="js_action_click" data-action="toggle_filter_sidebar" data-container="#js_favorite_items">
				<i class="zmdi zmdi-tune zmdi-hc-fw"></i>
				<span>Compare Places</span>
			</a>
		</div>
		
		<div class="row">
			<?php if(count($models)):?>
			<aside id="js_filter_bar" class="col-md-4 trans_me">
				<div class="sticky-block">
					<div id="js_compare_panel" class="card d-print-none compare-panel trans_all">
						<div class="header">
							<h2>Compare Places</h2>
							<small class="js_result_count_label">Vestibulum id ligula porta felis euismod semper</small>
							<a role="button" class="btn-close-filter btn btn-default trans_me d-block d-md-none" data-trigger="js_action_click" data-action="toggle_filter_sidebar" data-container="#js_compare_items">
								<i class="zmdi zmdi-close zmdi-hc-fw"></i>
								<span>Close</span>
							</a>
						</div>
						<div id="js_compare_items" class="list-group item-container"></div>
						<div class="footer">
							<?=Html::button('Compare These Places', ['id' => 'js_btn_compare', 'class' => 'btn btn-info', 'disabled' => 'disabled', 'data-trigger' => 'js_action_click', 'data-action' => 'compare_items']);?>
						</div>
					</div>
				</div>
			</aside>
			<div class="col-md-8">
				<div id="js_favorite_items" class="property-listing trans_all">
					<?=$this->render('@frontend/views/property/partials/items', ['models' => $models, 'add_to_compare' => true, 'desc_length' => 140]);?>
				</div>
			</div>
			<?php else:?>
			<div class="col-12">
				<div class="card mt-5 mb-5">
					<div class="body text-center pt-5 pb-5 mt-5 mb-5">
						<h2>Oops! You have no favorite properties.</h2>
						<small>Search for properties and add some to their favorites to use</small>
					</div>
				</div>
			</div>
			<?php endif;?>
		</div>
	
	
	</div>
</section>

