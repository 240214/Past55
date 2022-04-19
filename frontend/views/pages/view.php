<?php

use common\models\Users;
use frontend\assets\AppAsset;
use \yii\bootstrap\ActiveForm;
use yii\bootstrap\BootstrapAsset;

$this->registerMetaTag(['name' => 'description', 'content' => $model->meta_description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
if($model->meta_noindex){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title = $model->meta_title;
$this->params['breadcrumbs'][] = $model->title;

$this->registerCssFile('@web/theme/css/page.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);

?>
<section class="hero">
	<div class="container first-screen text-center max-w-700">
		<h1 class="main-title mb-15 mb-md-25 me-auto ms-auto"><?=$model->meta_title;?></h1>
	</div>
</section>

<section class="content">
	<div class="container">
		<?=$model['content'];?>
	</div>
</section>