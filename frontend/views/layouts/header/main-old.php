<?php

use yii\helpers\Url;
use frontend\widgets\UserFavorites;
?>

<div class="header__main">
	<div class="container-lg d-flex flex-row justify-content-between align-items-center">
		<a class="logo d-flex flex-row" href="<?=Url::toRoute('/')?>">
			<?php if(!empty(Yii::$app->params['settings']['logo'])):?>
			<img src="<?=Yii::getAlias('@web')?>/images/site/logo/<?=Yii::$app->params['settings']['logo'];?>" alt="">
			<?php endif;?>
			<div class="logo__text">
				<span><?=Yii::$app->params['settings']['site_name'];?></span>
				<span><?=Yii::$app->params['settings']['site_title'];?></span>
			</div>
		</a>
		<div class="mob-user-fav d-lg-none">
			<?=UserFavorites::widget();?>
		</div>
		<div class="navigation-trigger d-lg-none" data-trigger="js_action_click" data-action="toggle_mobile_nav" data-target=".navigation">
			<i class="zmdi zmdi-menu"></i>
		</div>
		<ul class="navigation">
			<li class="d-lg-none">
				<a role="button" class="navigation__close" data-trigger="js_action_click" data-action="toggle_mobile_nav" data-target=".navigation">
					<i class="zmdi zmdi-long-arrow-right"></i>
				</a>
			</li>
			<li class="<?=(Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'site/index') ? 'active' : ''?> navigation__dropdown">
				<a href="<?=Url::toRoute('/')?>">Home</a>
			</li>
			<li class="<?=(Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'favorites/index') ? 'active' : ''?> navigation__dropdown">
				<a href="<?=Url::toRoute('favorites/')?>/">Favorites</a>
			</li>
			<li class="<?=(Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'blog/index') ? 'active' : ''?> navigation__dropdown">
				<a href="<?=Url::toRoute('blog/index')?>">Blogs</a>
			</li>
			<li class="<?=(Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'page/view') ? 'active' : ''?> navigation__dropdown">
				<a href="<?=Url::toRoute(['page/view', 'slug' => 'about-us']);?>">About</a>
			</li>
			<li class="<?=(Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'site/contact') ? 'active' : ''?> navigation__dropdown">
				<a href="<?=Url::toRoute('site/contact')?>">Contact</a>
			</li>
		</ul>
	</div>
</div>

