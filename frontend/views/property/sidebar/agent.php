<?php

use yii\helpers\Url;
use common\models\Users;

?>
<div class="card">
	<div class="header">
		<h2>Agents representing</h2>
		<small>Etiam porta sem malesuada magna mollis</small>
	</div>
	<div class="list-group">
		<a class="list-group-item media" href="<?=Url::toRoute('user/profile/'.Users::agentDetail("username", $property['user_id']))?>">
			<div class="pull-left">
				<img src="<?=Yii::getAlias('@web')."/images/user/".Users::agentDetail("image", $property['user_id'])?>" alt="" class="list-group__img img-circle" width="65" height="65">
			</div>
			<div class="media-body list-group__text">
				<strong><?=Users::agentDetail("username", $property['user_id'])?></strong>
				<small class="list-group__text">+091-<?=Users::agentDetail("mobile", $property['user_id'])?></small>
				<div class="rmd-rate" data-rate-value="5" data-rate-readonly="true"></div>
			</div>
		</a>
		<div class="p-10"></div>
	</div>
</div>
