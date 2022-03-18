<?php

use common\models\Users;
use frontend\assets\AppAsset;
use frontend\widgets\Breadcrumbs;
use \yii\bootstrap\ActiveForm;
use yii\bootstrap\BootstrapAsset;
use yii\data\ActiveDataProvider;
use yii\web\View;
use frontend\widgets\PostAuthor;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerMetaTag(['name' => 'description', 'content' => $meta['description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $meta['keywords']]);
if($meta['noindex']){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title  = Yii::t('app', $model['title']);
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/theme/css/post.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);

#VarDumper::dump($model->users->id, 10, 1);
?>

<section class="article">
	<div class="container">
		
		<div class="row">
			<div class="col-12 col-xl-2"></div>
			<div class="col-12 col-xl-7">
				<?=Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]);?>
				<div class="article__stickers d-flex align-items-center flex-wrap mb-15">
					<div class="article-sticker me-1 mb-1 mb-md-0 d-flex align-items-center justify-content-center">Home</div>
					<div class="article-sticker me-1 mb-1 mb-md-0 d-flex align-items-center justify-content-center">Resources</div>
					<div class="article-sticker me-1 mb-1 mb-md-0 d-flex align-items-center justify-content-center">Senior Living</div>
				</div>
			</div>
			<div class="col-12 col-xl-3"></div>
		</div>

		<div class="row">

			<div class="col-12 col-xl-2">
				<div class="d-block d-xl-none">
					<h1 class="main-title mb-15"><?=$model['title'];?></h1>
					<div class="article-info-box d-flex mb-25">
						<span class="article__info me-2">By Jonathan Holloway</span>
						<span class="article__info me-1">July 30, 2021</span>
					</div>
				</div>
				<div class="article-content__open-tab-btn d-flex d-xl-none align-items-center justify-content-between mb-1">
					<span>Table of Contents</span>
					<img src="../shared/images/select-icon-checkbox.png" alt="">
				</div>
				<div class="article-content__body d-none d-xl-block">
					<h4 class="article__content-title">Content</h4>
					<a class="article__content-link article__content-link--active text-decoration-none mb-1" href="#">What is E-A-T</a>
					<a class="article__content-link text-decoration-none mb-1" href="#">How important is EAT?</a>
					<a class="article__content-link text-decoration-none mb-1" href="#">How is EAT evaluated?</a>
					<a class="article__content-link text-decoration-none mb-1" href="#">Is E-A-T a ranking factor?</a>
					<a class="article__content-link text-decoration-none mb-1" href="#">Do websites have an E-A-T score?</a>
					<a class="article__content-link text-decoration-none mb-1" href="#">How to improve and demonstrate E-A-T</a>
				</div>
				<div class="article-author__open-tab-btn d-flex d-xl-none align-items-center justify-content-between mb-2">
					<span>Author Bio</span>
					<img src="../shared/images/select-icon-checkbox.png" alt="">
				</div>
				<?=PostAuthor::widget(['user' => $model->users, 'wrapper_attrs' => ['id' => 'js_post_author_mob', 'class' => 'article-author__body d-none']]);?>
			</div>

			<div class="col-12 col-xl-7 main-text-content text-color-black">
				<h1 class="main-title mb-15"><?=$model['title'];?></h1>
				<div class="article-info-box d-flex mb-25">
					<span class="article__info me-2">By <?=$model->users->name;?></span>
					<span class="article__info me-1"><?=date('F j, Y', $model->created_at);?></span>
				</div>
				<?=$model['content'];?>
			</div>

			<div class="col-12 col-xl-3 d-none d-xl-block">
				<div class="sticky-block">
					<?=PostAuthor::widget(['user' => $model->users]);?>
				</div>
			</div>
			
		</div>
	</div>

	<div class="container main-text-content text-color-black">
		<div class="row">
			<div class="col-12 col-xl-2"></div>
			<div class="col-12 col-xl-8">
				<h3 class="article-subtitle-small">Related Articles</h3>
				<p class="mb-4">Trust is about the legitimacy, transparency, and accuracy of the</br> website and its content.</p>

				<div class="related-article-list row mb-0 mb-md-4">
					<div class="related-article-item col-12 col-md-6 mb-3 mb-md-0">
						<img class="img-fluid mb-2 mb-md-3" src="./img/related-article-1.png" alt="">
						<div class="related-article-item__sticker d-flex align-items-center justify-content-center mb-1">Raters look for a number</div>
						<a href="#" class="related-article-item__title mb-15 text-decoration-none">Keep content up to date Although the Quality Raters</a>
						<p class="related-article-item__text">Trust is about the legitimacy, transparency, and accuracy of the website and its content.</p>
					</div>
					<div class="related-article-item col-12 col-md-6 mb-3 mb-md-0">
						<img class="img-fluid mb-2 mb-md-3" src="./img/related-article-2.png" alt="">
						<div class="related-article-item__sticker d-flex align-items-center justify-content-center mb-1">Raters look for a number</div>
						<a href="#" class="related-article-item__title mb-15 text-decoration-none">Lots of people get hung up with this one</a>
						<p class="related-article-item__text">Trust is about the legitimacy, transparency, and accuracy of the website and its content.</p>
					</div>
				</div>
				<div class="related-article-list row mb-5">
					<div class="related-article-item col-12 col-md-6 mb-3 mb-md-0">
						<img class="img-fluid mb-2 mb-md-3" src="./img/related-article-3.png" alt="">
						<div class="related-article-item__sticker d-flex align-items-center justify-content-center mb-1">Raters look for a number</div>
						<a href="#" class="related-article-item__title mb-15 text-decoration-none">Keep content up to date Although the Quality Raters</a>
						<p class="related-article-item__text">Trust is about the legitimacy, transparency, and accuracy of the website and its content.</p>
					</div>
					<div class="related-article-item col-12 col-md-6">
						<img class="img-fluid mb-2 mb-md-3" src="./img/related-article-4.png" alt="">
						<div class="related-article-item__sticker d-flex align-items-center justify-content-center mb-1">Raters look for a number</div>
						<a href="#" class="related-article-item__title mb-15 text-decoration-none">Lots of people get hung up with this one</a>
						<p class="related-article-item__text">Trust is about the legitimacy, transparency, and accuracy of the website and its content.</p>
					</div>
				</div>
			</div>
			<div class="col-12 col-xl-2"></div>
		</div>
		<div class="divider-wrapp mb-2">
			<img src="../shared/images/divider.png" alt="">
		</div>
	</div>

</section>
