<?php if(!empty($property->description)):?>
	<div class="card-box big">
		<div class="header">
			<h2 class="title">About <?=$property->title;?></h2>
		</div>
		<div class="body">
			<div id="js_short_content" class="short-content">
				<?=$property->description;?>
			</div>
			<a role="button"
			   class="d-flex d-md-none justify-content-center align-items-center mt-2 text-decoration-none text-center read-more"
			   data-trigger="js_action_click"
			   data-action="toggle_display_block"
			   data-target="#js_short_content"
			   data-title="Read More"><i class="bi bi-chevron-down text-color-primary"></i> <span>Read More</span></a>
		</div>
	</div>
<?php endif;?>
