<?php

use yii\helpers\Url;

?>
<a href="<?=Url::toRoute('favorites/')?>/" role="button" class="btn btn-fav">
	<i class="zmdi zmdi-favorite check"></i> My Favorites
	<span class="badge js_user_favs_count"><?=$user_favs_count;?></span>
</a>