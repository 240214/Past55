<?php

use yii\helpers\Url;
use yii\helpers\VarDumper;

#VarDumper::dump($model, 10, 1);

foreach($model as $item){
	echo '<a href="'.Url::toRoute(['page/view', 'slug' => $item->slug]).'">'.$item->title.'</a>';
}
