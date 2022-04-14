<?php

use yii\helpers\Url;
use yii\helpers\VarDumper;

#VarDumper::dump($this->params['site'], 10, 1);
?>
<header class="main-header">
	
	<a href="<?=Url::toRoute('site/index');?>" class="logo">
		<span class="logo-mini"><b><?=$this->params['site']['site_short_name'];?></b></span>
		<span class="logo-lg"><b><?=$this->params['site']['site_name'];?></b></span>
	</a>
	
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<!-- Navbar Right Menu -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				
				<!-- Notifications: style can be found in dropdown.less -->
				
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?=Yii::$app->urlManagerFrontend->baseUrl.'/images/site/logo/'.$this->params['site']['logo'];?>" class="user-image" alt="User Image">
						<span class="hidden-xs"><?=$this->params['site']['site_name'];;?> Admin</span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="<?=Yii::$app->urlManagerFrontend->baseUrl.'/images/site/logo/'.$this->params['site']['logo'];?>" class="" alt="User Image">
							<p><small></small></p>
						</li>
						<!-- Menu Body -->
						<li class="user-body">
							<div class="col-xs-6 text-center">
								<a href="<?=Url::toRoute('settings/index');?>">Dashboard</a>
							</div>
							<div class="col-xs-6 text-center">
								<a href="<?=Url::toRoute('settings/admin');?>">Admin Setting</a>
							</div>
						
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="<?=Url::toRoute('settings/site');?>" class="btn btn-default btn-flat">Site Setting</a>
							</div>
							<div class="pull-right">
								<a data-method="POST" href="<?=Url::toRoute('site/logout');?>" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
				<!-- Control Sidebar Toggle Button -->
				<li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>
			</ul>
		</div>
	
	</nav>
</header>
