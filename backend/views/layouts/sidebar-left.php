<?php

use yii\helpers\Url;
use yii\helpers\VarDumper;

$navs = [
	[
		'type' => 'header',
		'key' => '',
		'class' => ['header'],
		'label' => 'MAIN NAVIGATION',
		'visible' => true,
	],
	[
		'type' => 'item',
		'key' => 'frontend',
		'label' => 'Home',
		'icon' => 'fa-home',
		'link' => '/',
		'class' => [],
		'method' => '',
		'visible' => true,
		'target' => '_blank',
	],
	[
		'type' => 'item',
		'key' => 'site',
		'label' => 'Dashboard',
		'icon' => 'fa-dashboard',
		'link' => Url::toRoute('site/index'),
		'class' => [],
		'method' => '',
		'visible' => true,
	],
	[
		'type' => 'item',
		'key' => 'property',
		'label' => 'Properties',
		'icon' => 'fa-list',
		'link' => Url::toRoute('property/index'),
		'class' => ['treeview'],
		'method' => '',
		'visible' => true,
		'submenu' => [
			'property' => [
				'label' => 'Property',
				'icon' => 'fa-list',
				'link' => Url::toRoute('property/index'),
				'class' => [],
				'visible' => true,
			],
			'category' => [
				'label' => 'Categories',
				'icon' => 'fa-th',
				'link' => Url::toRoute('category/index'),
				'class' => [],
				'visible' => true,
			],
			'property-features' => [
				'label' => 'Features',
				'icon' => 'fa-plug',
				'link' => Url::toRoute('property-features/index'),
				'class' => [],
				'visible' => true,
			],
			'property-features-types' => [
				'label' => 'Features types',
				'icon' => 'fa-plug',
				'link' => Url::toRoute('property-features-types/index'),
				'class' => [],
				'visible' => true,
			],
			'nearby-places' => [
				'label' => 'Nearby places',
				'icon' => 'fa-map-marker',
				'link' => Url::toRoute('nearby-places/index'),
				'class' => [],
				'visible' => true,
			],
			'nearby-places-types' => [
				'label' => 'Nearby places types',
				'icon' => 'fa-map-marker',
				'link' => Url::toRoute('nearby-places-types/index'),
				'class' => [],
				'visible' => true,
			],
			'sub-category' => [
				'label' => 'Property Options',
				'icon' => 'fa-bars',
				'link' => Url::toRoute('sub-category/index'),
				'class' => [],
				'visible' => false,
			],
		]
	],
	[
		'type' => 'item',
		'key' => 'location',
		'label' => 'Locations',
		'icon' => 'fa-map-marker',
		'link' => '#',
		'class' => ['treeview'],
		'method' => '',
		'visible' => true,
		'submenu' => [
			'country' => [
				'label' => 'Countries',
				'icon' => 'fa-flag',
				'link' => Url::toRoute('country/index'),
				'class' => [],
				'visible' => true,
			],
			'state' => [
				'label' => 'States',
				'icon' => 'fa-flag',
				'link' => Url::toRoute('state/index'),
				'class' => [],
				'visible' => true,
			],
			'city' => [
				'label' => 'Cities',
				'icon' => 'fa-flag',
				'link' => Url::toRoute('city/index'),
				'class' => [],
				'visible' => true,
			],
		],
	],
	[
		'type' => 'item',
		'key' => 'mortgage',
		'label' => 'Mortgage',
		'icon' => 'fa-money',
		'link' => Url::toRoute('mortgage/index'),
		'class' => [],
		'method' => '',
		'visible' => false,
	],
	[
		'type' => 'item',
		'key' => 'user',
		'label' => 'Users',
		'icon' => 'fa-user',
		'link' => Url::toRoute('site/user'),
		'class' => [],
		'method' => '',
		'visible' => true,
	],
	[
		'type' => 'item',
		'key' => 'newsletter',
		'label' => 'Subscribers',
		'icon' => 'fa-newspaper-o',
		'link' => Url::toRoute('/newsletter/'),
		'class' => [],
		'method' => '',
		'visible' => false,
	],
	[
		'type' => 'item',
		'key' => 'pages',
		'label' => 'Pages',
		'icon' => 'fa-book',
		'link' => Url::toRoute('pages/index'),
		'class' => [],
		'method' => '',
		'visible' => true,
	],
	[
		'type' => 'item',
		'key' => 'posts',
		'label' => 'Posts',
		'icon' => 'fa-list',
		'link' => Url::toRoute('posts/index'),
		'class' => ['treeview'],
		'method' => '',
		'visible' => true,
		'submenu' => [
			'posts' => [
				'label' => 'Posts',
				'icon' => 'fa-pagelines',
				'link' => Url::toRoute('posts/index'),
				'class' => [],
				'visible' => true,
			],
			'posts-category' => [
				'label' => 'Categories',
				'icon' => 'fa-th',
				'link' => Url::toRoute('posts-category/index'),
				'class' => [],
				'visible' => true,
			],
		]
	],
	[
		'type' => 'item',
		'key' => 'settings',
		'label' => 'Settings',
		'icon' => 'fa-gears',
		'link' => Url::toRoute('settings/site'),
		'class' => [],
		'method' => '',
		'visible' => true,
	],
	[
		'type' => 'item',
		'key' => 'statics',
		'label' => 'Statics',
		'icon' => 'fa-line-chart',
		'link' => Url::toRoute('statics/index'),
		'class' => [],
		'method' => '',
		'visible' => true,
	],
	[
		'type' => 'item',
		'key' => 'logout',
		'label' => 'Logout',
		'icon' => 'fa-power-off',
		'link' => Url::toRoute('site/logout'),
		'class' => [],
		'method' => 'POST',
		'visible' => true,
	],
];
#VarDumper::dump($navs, 10, 1);
$r = explode('/', Yii::$app->request->getPathInfo());
#VarDumper::dump($r, 10, 1); exit;
$first_path = $r[0];
#$second_path = $r[1];
$submenu_class = in_array($first_path, ['property', 'property-features', 'category', 'posts-category', 'nearby-places', 'nearby-places-types']) ? 'menu-open' : '';
?>
<aside class="main-sidebar trans_all">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<?php foreach($navs as $nav):?>
				<?php if($nav['visible']):?>
					<?php
					if($first_path == $nav['key'])
						$nav['class'][]= 'active';
					if(isset($nav['submenu']) && in_array($first_path, array_keys($nav['submenu'])))
						$nav['class'][] = 'active';
					
					$nav['class'] = implode(' ', array_unique($nav['class']));
					?>
					<?php if($nav['type'] == 'header'):?>
						<li class="<?=$nav['class'];?>"><?=$nav['label'];?></li>
					<?php else:?>
						<?php
							$method = (!empty($nav['method']) ? 'data-method="'.$nav['method'].'"' : '');
							$target = (!empty($nav['target']) ? 'target="'.$nav['target'].'"' : '');
						?>
						<li class="<?=$nav['class'];?>">
							<a <?=$method;?> <?=$target;?> href="<?=$nav['link'];?>"><i class="fa <?=$nav['icon'];?>"></i> <span><?=$nav['label'];?></span></a>
							<?php if(isset($nav['submenu'])):?>
							<ul class="treeview-menu">
								<?php foreach($nav['submenu'] as $k => $menu):?>
									<?php
									if($first_path == $k)
										$menu['class'][]= 'active';
									
									$menu['class'] = implode(' ', array_unique($menu['class']));
									?>
									<?php if($menu['visible']):?>
										<li class="<?=$menu['class'];?>"><a href="<?=$menu['link'];?>"><i class="fa <?=$menu['icon'];?>"></i><span><?=$menu['label'];?></span></a></li>
									<?php endif;?>
								<?php endforeach;?>
							</ul>
							<?php endif;?>
						</li>
					<?php endif;?>
				<?php endif;?>
			<?php endforeach;?>
		</ul>
	</section>
</aside>
