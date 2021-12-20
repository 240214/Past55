<?php

use yii\helpers\Url;
use frontend\widgets\UserFavorites;
?>

<div class="header-logo"><a class="" href="<?=Url::toRoute('/')?>"><?=Yii::$app->params['settings']['site_title'];?></a></div>
<div class="flex-grow-1 d-none d-md-block">
	<nav>
		<ul class="d-none d-md-flex align-items-center justify-content-center mb-0 p-0">
			<li class="me-3"><a class="header__link header__link--active text-decoration-none" href="<?=Url::toRoute('/')?>">Home</a></li>
			<li class="me-3"><a class="header__link text-decoration-none" href="#">Our policies</a></li>
			<li class="me-3"><a class="header__link text-decoration-none" href="#">Learn & Plans</a></li>
			<li class=""><a class="header__link text-decoration-none" href="#">Why GeorgiaCaring</a></li>
		</ul>
	</nav>
</div>
<div class="d-none d-md-block"><a href="tel:11234567890" class="header-home__tel text-decoration-none"><i class="zmdi zmdi-phone me-1"></i>1-123-456-7890</a></div>
<div class="d-flex d-md-none align-items-center">
	<a href="#" class="header-home__favorite-box d-flex align-items-center justify-content-center me-1 text-decoration-none"><i class="bi bi-heart-fill text-color-primary me-1"></i> My Favorites</a>
	<div class="header-home__menu-icon"><i class="zmdi zmdi-menu"></i></div>
</div>
