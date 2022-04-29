<?php

use yii\helpers\VarDumper;
use frontend\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;
use frontend\widgets\PostsCarousel;

$this->registerMetaTag(['name' => 'description', 'content' => '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
if(YII_ENV_DEV){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/theme/css/authors.css?v='.YII_CSS_VERS, ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);

?>
<section class="authors">
	<div class="container">
		<h1 class="main-title text-center mb-1 mb-md-2"><?=$this->title;?></h1>
		<p class="main-text-content text-center mb-5 mb-md-7">Lorem ipsum dolor sit amet.</p>
		
		<div class="row">
			<?php foreach($authors as $author):?>
				<div class="col-12 col-sm-6 col-lg-4 mb-2 mb-md-3">
					<div class="box text-center trans-all">
						<?=$author->FormatedAvatar;?>
						<div class="name ff-pt-serif">
							<a href="/authors/<?=$author->username;?>/"><?=$author->name;?></a>
						</div>
						<?=$author->RatingStars;?>
						<div class="divider"></div>
						<div class="position"><?=$author->position;?></div>
						<?php if(!empty($author->SocialLinks)):?>
							<div class="d-flex flex-wrap justify-content-center">
								<?php foreach($author->SocialLinks as $name => $link):?>
									<a href="<?=$link;?>" target="_blank" class="social-icon d-flex align-items-center justify-content-center rounded-circle m-05"><i class="zmdi zmdi-<?=$name;?>"></i></a>
								<?php endforeach;?>
							</div>
						<?php endif;?>
					</div>
				</div>
			<?php endforeach;?>
		</div>
	</div>
</section>

<section class="articles container pt-3 pt-md-9 pb-1">
	<div class="d-flex justify-content-between mb-45 mb-md-5">
		<h3 class="main-title">Latest Articles</h3>
		<a class="content-library__see-all-link d-none text-decoration-underline" href="#">See All</a>
	</div>
	<?=PostsCarousel::widget(['post_type' => 'post', 'limit' => 4, 'display_post_type' => true, 'display_nav_arrows' => false]);?>
	<a class="content-library__see-all-link d-none text-decoration-underline mb-1" href="#">See All</a>
</section>
