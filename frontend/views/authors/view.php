<?php

use yii\helpers\VarDumper;
use frontend\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;
use frontend\widgets\PostsCarousel;
use yii\web\JqueryAsset;
use yii\widgets\LinkPager;

$this->registerMetaTag(['name' => 'description', 'content' => '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
if(YII_ENV_DEV){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title = $user->name;
$this->params['breadcrumbs'][] = $user->name;

$this->registerCssFile('@web/theme/css/author.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);

?>
<section class="hero">
	<div class="container first-screen max-w-630">
		<div class="author-box text-center trans-all">
			<?=$user->FormatedAvatar;?>
			<div class="name ff-pt-serif"><?=$user->name;?></div>
			<div class="divider"></div>
			<div class="position mb-2"><?=$user->position;?></div>
			<?php if(!empty($user->SocialLinks)):?>
				<div class="d-flex flex-wrap justify-content-center mb-2 mb-md-4">
					<?php foreach($user->SocialLinks as $name => $link):?>
						<a href="<?=$link;?>" target="_blank" class="social-icon d-flex align-items-center justify-content-center rounded-circle m-05"><i class="zmdi zmdi-<?=$name;?>"></i></a>
					<?php endforeach;?>
				</div>
			<?php endif;?>
			<?=$user->FormatedAbout;?>
		</div>
	</div>
</section>

<section class="posts">
	<div class="container">
		<div class="row mb-3 mb-md-5">
			<div class="col-12">
				<h2 class="main-title ff-pt-serif"><?=$postsSectionTitle;?></h2>
			</div>
		</div>
		
		<div class="row trans-all <?=(!$postsDataProvider->getCount() ? 'no-results' : '');?>">
			<?php if($postsDataProvider->getCount()):?>
				<?=$this->render('partials/items', ['models' => $postsDataProvider->getModels()]);?>
			<?php else:?>
				<div class="col-12 text-center">
					<h3>We're sorry, there are no posts.</h3>
				</div>
			<?php endif;?>
		</div>

		<div class="row mt-2 mt-md-35">
			<nav class="col-12 d-flex d-md-block justify-content-center justify-content-md-start">
				<?=LinkPager::widget([
					'pagination' => $postsDataProvider->getPagination(),
					'pageCssClass' => 'page-item',
					'prevPageCssClass' => 'page-item prev',
					'nextPageCssClass' => 'page-item next',
					'linkOptions' => ['class' => 'page-link'],
					'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'],
				]);?>
			</nav>
		</div>
	</div>
</section>
