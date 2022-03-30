<div class="card-box">
	<div class="header">
		<h2 class="title mb-2"><?=$property->title;?> Distance Calculator</h2>
		<small class="address mb-15"><i class="bi bi-geo-alt-fill me-1 text-color-primary"></i><?=$property->address;?></small>
		<div class="subtitle">Location is important. You can input addresses, names of businesses, or popular places to quickly see how far away they are from the housing facility.</div>
	</div>
	<div id="js_customer_addresses" class="body position-relative mt-25">
		<?=$this->render('../../customer/addresses-list', ['customer_addresses' => $property->customer_addresses, 'property' => $property]);?>
	</div>
</div>
