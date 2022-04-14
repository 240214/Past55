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
	
	<nav class="navbar navbar-static-top" role="navigation">
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
\		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?=Yii::$app->urlManagerFrontend->baseUrl.'/images/site/logo/'.$this->params['site']['logo'];?>" class="user-image" alt="User Image">
						<span class="hidden-xs"><?=$this->params['site']['site_name'];?> Admin</span>
					</a>
					<ul class="dropdown-menu">
						<li class="user-body"><a href="<?=Url::toRoute('settings/admin');?>">Admin Profile</a></li>
						<li class="user-body"><a href="<?=Url::toRoute('settings/site');?>">Site Setting</a></li>
						<li class="user-body"><a href="<?=Url::toRoute('settings/index');?>">Global Settings</a></li>
						<li class="user-body"><a data-method="POST" href="<?=Url::toRoute('site/logout');?>">Sign out</a></li>
					</ul>
				</li>
				<li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>
			</ul>
		</div>
	
	</nav>
</header>
