<?php

use yii\helpers\VarDumper;
use frontend\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;
use frontend\widgets\PostsCarousel;
use yii\web\JqueryAsset;

$this->registerMetaTag(['name' => 'description', 'content' => '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
if(YII_ENV_DEV){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title = $model->name;
$this->params['breadcrumbs'][] = $model->name;

$this->registerCssFile('@web/theme/css/author.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);

?>
<section class="hero">
	<div class="container first-screen max-w-630">
		<div class="author-box text-center trans-all">
			<?=$model->FormatedAvatar;?>
			<div class="name ff-pt-serif"><?=$model->name;?></div>
			<div class="divider"></div>
			<div class="position mb-2"><?=$model->position;?></div>
			<?php if(!empty($model->SocialLinks)):?>
				<div class="d-flex flex-wrap justify-content-center mb-2 mb-md-4">
					<?php foreach($model->SocialLinks as $name => $link):?>
						<a href="<?=$link;?>" target="_blank" class="social-icon d-flex align-items-center justify-content-center rounded-circle m-05"><i class="zmdi zmdi-<?=$name;?>"></i></a>
					<?php endforeach;?>
				</div>
			<?php endif;?>
			<?=$model->FormatedAbout;?>
		</div>
	</div>
</section>

<section class="posts">
	<h2></h2>
</section>
