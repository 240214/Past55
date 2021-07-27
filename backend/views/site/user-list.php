<?php

/* @var $this yii\web\View */
$site = \common\models\SiteSettings::find()->one();

$this->title = "User List";
use \yii\web\Request;
$baseUrl = str_replace('/backend/web', '', (new Request)->getBaseUrl());
Yii::setAlias('@front',$baseUrl. '/frontend/web');
$front  = Yii::getAlias('@front');


$baseUrl2 = str_replace('/backend/web', '', (new Request)->getBaseUrl());
Yii::setAlias('@frontUr',$baseUrl2. '');
$frontur  = Yii::getAlias('@frontUr');


?>
<!-- page content -->
<div class="">


    <div class="row">
        <div class="col-lg-12">
            <ul class="list-group">
                <?php
                foreach($model as $list)
                {
                    $frnd = $list;
                    ?>
                    <li class="list-group-item">
                        <img width="80px" src="<?= $front; ?>/images/user/<?= $frnd['image']; ?>"  class="img-responsive pull-left">
                        <span style="padding: 5px 10px;display: inline-block">
                                        <strong>
                                            <?= $frnd['name']; ?>
                                        </strong>
                                        <br>
                            <?= $frnd['role']; ?>,  <?= $frnd['email']; ?>

                                    </span>
                        <div class="dropdown pull-right">
                            <span style="cursor: pointer;padding: 10px;" class="glyphicon glyphicon-option-vertical dropdown-toggle" id="option1" data-toggle="dropdown"></span>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu" aria-labelledby="option1">
                                <li role="presentation">
                                    <a  style="padding: 10px" data-toggle="modal" data-target="#<?= $frnd['username']; ?>" tabindex="-1" class="primary">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                        View Profile
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="<?= \yii\helpers\Url::toRoute('/site/user-delete/'.$frnd['id']) ?>" style="padding: 10px" role="menuitem" tabindex="-1" class="primary">
                                        <span class="glyphicon glyphicon-trash"></span>
                                        Delete
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <!-- Modal profile-->
                        <div class="modal fade" id="<?= $frnd['username']; ?>" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><?= $frnd['name']; ?> profile</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php

                                        $model = $frnd;
                                        ?>




                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="panel">
                                                    <img src="<?= $front ?>/images/user/<?= $model['image'] ?>" class="img-responsive">

                                                    <div class="panel-body">
                                                        <b><?= $model['name'] ?></b>
                                                    </div>
                                                </div>
                                                <!--   panel end-->

                                            </div>
                                            <div class="col-lg-9">
                                                <div id="msgboxr"></div>
                                                <div class="panel">
                                                    <div class="panel-body">
                                                        <b>
                                                            Basic Information of <i class="primary"><?= $model['name'] ?></i>
                                                        </b>
                                                        <h6>
                                                            member from <?= date('d/M/Y',$model['created_at']); ?>
                                                        </h6>
                                                        <hr>
                                                        <table width="100%">
                                                            <tr>
                                                                <td>
                                                                    <strong style="color: #555">UserName: </strong>
                                                                </td>
                                                                <td>
                                                                    <span style="color: #555"> <?= $model['name'] ?></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>Name: </strong>
                                                                </td>
                                                                <td>
                                                                    <?= $model['name'] ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>Email: </strong>
                                                                </td>
                                                                <td>
                                                                    <?= $model['email'] ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>Mobile: </strong>
                                                                </td>
                                                                <td>
                                                                    <?= $model['mobile'] ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>Location: </strong>
                                                                </td>
                                                                <td>
                                                                    <?= $model['city'] ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>Role: </strong>
                                                                </td>
                                                                <td>
                                                                    <?= $model['role'] ?>
                                                                </td>
                                                            </tr>



                                                        </table>

                                                    </div>
                                                </div>
                                                <div class="panel">
                                                    <div class="panel-body">
                                                        <b>
                                                            About
                                                        </b>

                                                        <hr>
                                                        <blockquote>
                                                            <?= $model['about'] ?>
                                                        </blockquote>
                                                    </div>
                                                </div>

                                                <div class="panel">
                                                    <div class="panel-body">
                                                        <b>
                                                            Listing

                                                        </b>
                                                        <hr>
                                                        <?php
                                                        $listing = \common\models\Property::find()->where(['user_id'=>$model['id']])->all();

                                                        if(empty($listing))
                                                        {
                                                            echo "No property yet";
                                                        }
                                                        foreach($listing as $list)
                                                        {

                                                            ?>
                                                            <div style="width: 200px;height: 200px;overflow: hidden;display: inline-block;">
                                                                <img src="<?= $front; ?>/images/property/cover/<?= $list['image'] ?>"  class="img-responsive img-thumbnail">
                                                                <h6>
                                                                    <?= $list['title'] ?>
                                                                </h6>
                                                                <a href="<?= $frontur; ?>/property/view/<?= base64_encode($list['id']) ?>">View</a>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>



                                                    </div>

                                                </div>

                                            </div>
                                        </div>




                                    </div>
                                    <div class="modal-footer">


                                        <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
