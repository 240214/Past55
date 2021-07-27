<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Image management';
$this->params['breadcrumbs'][] = $this->title;
use \yii\web\Request;
$baseUrl = str_replace('/backend/web', '', (new Request)->getBaseUrl());
Yii::setAlias('@front',$baseUrl. '/frontend/web');
$front  = Yii::getAlias('@front');

?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-body">
                <ul class="list-group">
                    <?php
                    foreach($model as $list)
                    {
                        ?>
                        <li class="list-group-item">
                            <img width="80px" src="<?= $front; ?>/images/members/album/<?= $list['image']; ?>"  class="img-responsive pull-left">

                            <div class="dropdown pull-right">
                                <span style="cursor: pointer;padding: 10px;" class="glyphicon glyphicon-option-vertical dropdown-toggle" id="option1" data-toggle="dropdown"></span>
                                <ul class="dropdown-menu dropdown-menu-left" role="menu" aria-labelledby="option1">

                                    <li role="presentation">
                                        <a href="<?= \yii\helpers\Url::to(Yii::getAlias('@web').'/index.php?r=settings/image-delete&id='.$list['id'],false) ?>" style="padding: 10px" role="menuitem" tabindex="-1" class="primary">
                                            <span class="glyphicon glyphicon-trash"></span>
                                            Delete
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>

                        </li>
                    <?php
                    }
                    ?>


                </ul>

                <?php
                // display pagination
                echo \yii\widgets\LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            </div>
        </div>
    </div>
</div>