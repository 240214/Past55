<?php

use yii\helpers\VarDumper;
use frontend\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;
use frontend\widgets\PostsCarousel;

$this->registerMetaTag(['name' => 'description', 'content' => $model->meta_description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
if($model->meta_noindex){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title = $model->meta_title;
$this->params['breadcrumbs'][] = $model->title;

$this->registerCssFile('@web/theme/css/pages/resources.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);

?>
<section class="content-library">
	<div class="content-library__body">
		<div class="container">
			<h1 class="main-title text-center mb-1 mb-md-2">Content Library</h1>
			<p class="main-text-content text-center mb-5 mb-md-7">People started talking about E‑A-T in August 2018, and it’s been mentioned<br>in hundreds of SEO articles ever since.</p>

			<?=PostsCarousel::widget(['post_type' => 'article', 'listing_category_id' => 1]);?>
			<?=PostsCarousel::widget(['post_type' => 'article', 'listing_category_id' => 5]);?>
			<?=PostsCarousel::widget(['post_type' => 'article', 'listing_category_id' => 3]);?>
		</div>
	</div>
</section>

<section class="container pt-3 pt-md-9 pb-1">
	<div class="d-flex justify-content-between mb-45 mb-md-5">
		<h3 class="latest-articles__row-title">Latest Articles</h3>
		<a class="content-library__see-all-link d-none text-decoration-underline" href="#">See All</a>
	</div>
	<?=PostsCarousel::widget(['post_type' => 'post', 'limit' => 4, 'display_post_type' => true, 'display_nav_arrows' => false]);?>
	<a class="content-library__see-all-link d-none text-decoration-underline mb-1" href="#">See All</a>
</section>
