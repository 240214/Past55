<?php if($property->display_contact_widget):?>
<div class="card-box">
	<div class="header mb-2">
		<h2 class="title">Contact Info</h2>
		<?php if(!empty($property->contact_widget_title)):?>
		<div class="subtitle"><?=str_replace('{PROPERTY_TITLE}', $property->title, $property->contact_widget_title);?></div>
		<?php endif;?>
	</div>
	<div class="body">
		<ul class="contact-info-items p-0 m-0">
			<?php if(!empty($property->contact_phone)):?>
				<li>
					<div class="icon-wrapp me-2 text-color-primary"><i class="bi bi-telephone-fill"></i></div>
					<a class="item" href="tel:+1<?=str_replace(['(', ')', '-', '+1', ' '], '', $property->contact_phone);?>"><?=$property->contact_phone;?></a>
				</li>
			<?php endif;?>
			<?php if(!empty($property->contact_email)):?>
				<li>
					<div class="icon-wrapp me-2 text-color-primary"><i class="bi bi-envelope-fill"></i></div>
					<a class="item" href="mailto:<?=$property->contact_email;?>"><?=$property->contact_email;?></a>
				</li>
			<?php endif;?>
			<?php if(!empty($property->contact_website)):?>
				<li>
					<div class="icon-wrapp me-2 text-color-primary"><i class="bi bi-link"></i></div>
					<a class="item" href="<?=$property->contact_website;?>" target="_blank">Community Website</a>
				</li>
			<?php endif;?>
			<?php if(!empty($property->contact_address)):?>
				<li>
					<div class="icon-wrapp me-2 text-color-primary"><i class="bi bi-geo-alt-fill"></i></div>
					<span class="item"><?=$property->contact_address;?></span>
				</li>
			<?php endif;?>
		</ul>
		<?php if(!empty($property->contacts)):?>
			<div class="mt-4"><?=$property->contacts;?></div>
		<?php endif;?>
	</div>
</div>
<?php endif;?>

