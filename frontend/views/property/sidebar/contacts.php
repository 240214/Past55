<?php if($property->display_contact_widget):?>
<div class="card">
	<div class="header">
		<h2>Contact Info</h2>
	</div>
	<div class="body">
		<?php if(!empty($property->contact_widget_title)):?>
			<div class="fw-bold">
			<?=str_replace('{PROPERTY_TITLE}', $property->title, $property->contact_widget_title);?>
			</div>
		<?php endif;?>
		<div class="contact-info-items mt-4">
			<?php if(!empty($property->contact_phone)):?>
				<div class="d-flex flex-nowrap align-items-start mb-2">
					<i class="zmdi zmdi-hc-fw zmdi-phone me-3"></i>
					<a class="item" href="tel:+1<?=str_replace(['(', ')', '-', '+1', ' '], '', $property->contact_phone);?>"><?=$property->contact_phone;?></a>
				</div>
			<?php endif;?>
			<?php if(!empty($property->contact_email)):?>
				<div class="d-flex flex-nowrap align-items-start mb-2">
					<i class="zmdi zmdi-hc-fw zmdi-email me-3"></i>
					<a class="item" href="mailto:<?=$property->contact_email;?>"><?=$property->contact_email;?></a>
				</div>
			<?php endif;?>
			<?php if(!empty($property->contact_website)):?>
				<div class="d-flex flex-nowrap align-items-start mb-2">
					<i class="zmdi zmdi-hc-fw zmdi-link me-3"></i>
					<a class="item" href="<?=$property->contact_website;?>" target="_blank">Community Website</a>
				</div>
			<?php endif;?>
			<?php if(!empty($property->contact_address)):?>
				<div class="d-flex flex-nowrap align-items-start mb-2">
					<i class="zmdi zmdi-hc-fw zmdi-pin me-3"></i>
					<span class="item"><?=$property->contact_address;?></span>
				</div>
			<?php endif;?>
		</div>
		<?php if(!empty($property->contacts)):?>
			<div class="mt-4"><?=$property->contacts;?></div>
		<?php endif;?>
	</div>
</div>
<?php endif;?>

