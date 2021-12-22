<?php

use yii\helpers\Url;
use yii\helpers\VarDumper;

#VarDumper::dump($model, 10, 1);

$title = !empty($custom_title) ? $custom_title : $model->title;
?>
<a href="<?=Url::toRoute(['page/view', 'slug' => $model->slug]);?>" class="<?=$tag_class;?>"><?=$title;?></a>