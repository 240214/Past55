<?php

use yii\helpers\Url;
use yii\helpers\VarDumper;

$r = explode('/', Yii::$app->request->getPathInfo());
$first_path = $r[0];
$second_path = $r[1];
$submenu_class = in_array($first_path, ['property', 'property-features', 'category', 'nearby-places', 'nearby-places-types']) ? 'menu-open' : '';
?>
<aside class="main-sidebar trans_all">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">MAIN NAVIGATION</li>
			<li class="active"><a href="<?=Url::toRoute('site/index');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
			<li class="treeview">
				<a href="<?=Url::toRoute('property/index');?>"><i class="fa fa-list"></i><span>Property</span></a>
				<ul class="treeview-menu <?=$submenu_class;?>">
					<li><a href="<?=Url::toRoute('property/index');?>"><i class="fa fa-list"></i><span>listings</span></a></li>
					<li><a href="<?=Url::toRoute('property-features/index');?>"><i class="fa fa-plug"></i><span>Features</span></a></li>
					<li><a href="<?=Url::toRoute('category/index');?>"><i class="fa fa-th"></i><span>Categories</span></a></li>
					<li><a href="<?=Url::toRoute('nearby-places/index');?>"><i class="fa fa-map-marker"></i><span>Nearby places</span></a></li>
					<li><a href="<?=Url::toRoute('nearby-places-types/index');?>"><i class="fa fa-map-marker"></i><span>Nearby places types</span></a></li>
					<?php /*<li><a href="<?=Url::toRoute('sub-category/index');?>"><i class="fa fa-bars"></i><span>Property Options</span></a></li>*/?>
				</ul>
			</li>
			<li class="treeview">
				<a href="#"><i class="fa fa-map-marker"></i><span>Location</span></a>
				<ul class="treeview-menu">
					<li><a href="<?=Url::toRoute('location/city');?>"><i class="fa fa-plus-square-o"></i>Listed Cities</a></li>
					<li><a href="<?=Url::toRoute('location/state');?>"><i class="fa fa-plus-square-o"></i>Listed States</a></li>
					<li><a href="<?=Url::toRoute('location/country');?>"><i class="fa fa-plus-square-o"></i>Listed Country</a></li>
				</ul>
			</li>
			<?php /*<li><a href="<?=Url::toRoute('mortgage/index');?>"><i class="fa fa-money"></i><span>Mortgage Management</span></a></li>*/?>
			<li><a href="<?=Url::toRoute('site/user');?>"><i class="fa fa-user"></i><span>User Management</span></a></li>
			<?php /*<li><a href="<?=Url::toRoute('/newsletter/');?>"><i class="fa fa-newspaper-o"></i><span>NewsLetter Subscriber</span></a></li>*/?>
			<li><a href="<?=Url::toRoute('pages/index');?>"><i class="fa fa-book"></i><span>Page Management</span></a></li>
			<li><a href="<?=Url::toRoute('settings/site');?>"><i class="fa fa-gears"></i><span>Site Setting</span></a></li>
			<li><a href="<?=Url::toRoute('/statics/index');?>"><i class="fa fa-line-chart"></i><span>Statics</span></a></li>
			<li><a data-method="POST" href="<?=Url::toRoute('site/logout');?>"><i class="fa fa-power-off"></i><span>Logout</span></a></li>
		</ul>
	</section>
</aside>
