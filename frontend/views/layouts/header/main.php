<?php

use yii\helpers\Url;
use frontend\widgets\UserFavorites;
use yii\widgets\Menu;
use frontend\widgets\NavMenu;
?>

<div class="header-logo"><a class="" href="<?=Url::toRoute('/')?>"><?=Yii::$app->params['settings']['site_title'];?></a></div>
<div class="flex-grow-1 d-md-block navigation trans-all">
	<a role="button" class="nav-control close d-flex d-md-none flex-row flex-nowrap justify-content-between" data-trigger="js_action_click" data-action="toggle_mobile_nav" data-target=".navigation">
		<span class="header-logo"><?=Yii::$app->params['settings']['site_title'];?></span>
		<i class="zmdi zmdi-long-arrow-right"></i>
	</a>
	<nav>
		<?=NavMenu::widget([
			'options' => ['class' => 'd-block d-md-flex align-items-center justify-content-center mb-0 p-0'],
			'encodeLabels' => false,
			'activeCssClass' => 'active',
			'linkTemplate' => '<a href="{url}" class="{class}">{label}</a>',
			'items' => [
				[
					'label' => 'Home',
					'url' => Url::toRoute('/')
				],
				[
					'label' => 'Resources',
					'url' => Url::to('/resources/')
				],
				[
					'label' => 'Independent Living',
					'url' =>  '/independent-living/ga/'
					#'url' => Url::toRoute(['property/index', 'category_slug' => 'independent-living'])
				],
				[
					'label' => 'Assisted Living',
					'url' =>  '/assisted-living/ga/'
					#'url' => Url::toRoute(['property/index', 'category_slug' => 'assisted-living'])
				],
				[
					'label' => 'Memory Care',
					'url' =>  '/memory-care/ga/'
					#'url' => Url::toRoute(['property/index', 'category_slug' => 'memory-care'])
				],
			],
		]);?>
	</nav>
</div>
<div class="d-none d-md-none"><a href="tel:<?=Yii::$app->params['settings']['mobile'];?>" class="header-home__tel text-decoration-none"><i class="zmdi zmdi-phone me-1"></i><?=Yii::$app->params['settings']['mobile'];?></a></div>
<div class="d-flex align-items-center">
	<?=UserFavorites::widget();?>
	<a role="button" class="nav-control d-md-none" data-trigger="js_action_click" data-action="toggle_mobile_nav" data-target=".navigation"><i class="zmdi zmdi-menu"></i></a>
</div>
