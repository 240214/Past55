<?php

use common\models\Users;
use frontend\assets\AppAsset;
use \yii\bootstrap\ActiveForm;
use yii\bootstrap\BootstrapAsset;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\helpers\VarDumper;
use frontend\widgets\Breadcrumbs;
use frontend\widgets\PostAuthor;
use frontend\widgets\PostContentList;
use frontend\widgets\RelatedPosts;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerMetaTag(['name' => 'description', 'content' => $meta['description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $meta['keywords']]);
if($meta['noindex']){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title  = Yii::t('app', $model['title']);
$this->params['breadcrumbs'][] = ['label' => 'Resources', 'url' => '/resources/'];
$this->params['breadcrumbs'][] = ['label' => $model->category->name, 'url' => '/'.$model->category->slug.'/'];
#$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/theme/css/post.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);

#VarDumper::dump($model->category_id, 10, 1);
?>
<section class="article">
	<div class="container-fluid container-xl">
		<div class="row">
			<div class="col-12 col-md-2"></div>
			<div class="col-12 col-md-10">
				<?=Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]);?>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-2">
				<div class="d-block d-md-none">
					<h1 class="main-title mb-15"><?=$model['title'];?></h1>
					<div class="article-info-box d-flex mb-25">
						<span class="article__info me-2">By <?=$model->users->name;?></span>
						<span class="article__info me-1"><?=date('F j, Y', $model->created_at);?></span>
					</div>
				</div>
				<div class="article-content__open-tab-btn d-flex d-md-none align-items-center justify-content-between mb-1">
					<span>Table of Contents</span>
					<img src="../shared/images/select-icon-checkbox.png" alt="">
				</div>
				<div class="article-content__body sticky-block d-none d-md-block">
					<?=PostContentList::widget(['title' => 'Content', 'model' => $model]);?>
				</div>
				<div class="article-author__open-tab-btn d-flex d-md-none align-items-center justify-content-between mb-2">
					<span>Author Bio</span>
					<img src="../shared/images/select-icon-checkbox.png" alt="">
				</div>
				<?=PostAuthor::widget(['user' => $model->users, 'wrapper_attrs' => ['id' => 'js_post_author_mob', 'class' => 'article-author__body d-none']]);?>
			</div>
			<div class="col-12 col-md-7 main-text-content text-color-black">
				<h1 class="main-title mb-15"><?=$model['title'];?></h1>
				<div class="article-info-box d-flex mb-25">
					<span class="article__info me-2">By <?=$model->users->name;?></span>
					<span class="article__info me-1"><?=date('F j, Y', $model->created_at);?></span>
				</div>
				<?=$model['content'];?>
			</div>
			<div class="col-12 col-md-3 d-none d-md-block">
				<div class="sticky-block">
					<?=PostAuthor::widget(['user' => $model->users]);?>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="container-fluid container-xl main-text-content text-color-black">
	<div class="row">
		<div class="col-12 col-md-2"></div>
		<div class="col-12 col-md-8">
			<?=RelatedPosts::widget([
				'current_post_id' => $model->id,
				'category_id' => $model->category_id,
				'title' => 'Related Articles',
				'subtitle' => 'Trust is about the legitimacy, transparency, and accuracy of the</br> website and its content.'
			]);?>
		</div>
		<div class="col-12 col-md-2"></div>
	</div>
	<div class="row">
		<div class="col-12 col-md-2"></div>
		<div class="col-12 col-md-10">
			<div class="divider-wrapp mb-2 dash-line"></div>
		</div>
</section>
