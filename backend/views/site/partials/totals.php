<?php
use yii\helpers\Url;
?>
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3><?=$totals['total_listings_count'];?></h3>
				<p>Total properties</p>
			</div>
			<div class="icon">
				<i class="ion ion-bag"></i>
			</div>
			<a href="<?=Url::toRoute(['property/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-green">
			<div class="inner">
				<h3><?=$totals['active_listings_count'];?></h3>
				<p>Active properties</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="<?=Url::toRoute(['property/index', 'SearchProperty[active]' => 1]);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-red">
			<div class="inner">
				<h3><?=$totals['pending_listings_count'];?></h3>
				<p>Pending properties</p>
			</div>
			<div class="icon">
				<i class="ion ion-ios-speedometer-outline"></i>
			</div>
			<a href="<?=Url::toRoute(['property/index', 'SearchProperty[active]' => 0]);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3><?=$totals['total_users_count'];?></h3>
				<p>Total Users</p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
			<a href="<?=Url::toRoute(['users/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
</div>
