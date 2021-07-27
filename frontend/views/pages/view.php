<?php

use common\models\User;
use \yii\bootstrap\ActiveForm;

$this->title  = Yii::t('app', $model['title']);
$this->params['breadcrumbs'][] = $this->title;

?>

<section class="section">
	<div class="container">
		<header class="section__title text-start">
			<h2><?=$model['title'];?></h2>
			<small><?=$site->site_name;?></small>

			<div class="actions actions--section">

			</div>
		</header>

		<div class="col-md-10">
			<p>
				<?=$model['content'];?>
			</p>
		</div>
	</div>
</section>