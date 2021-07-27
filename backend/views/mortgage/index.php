<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 05-03-2016
 * Time: 13:20
 */

$this->title = 'Mortgage List';
$this->params['breadcrumbs'][] = $this->title;
use \yii\web\Request;
$baseUrl = str_replace('/backend/web', '', (new Request)->getBaseUrl());
Yii::setAlias('@front',$baseUrl. '/frontend/web');
$front  = Yii::getAlias('@front');


$baseUrl2 = str_replace('/backend/web', '', (new Request)->getBaseUrl());
Yii::setAlias('@frontUr',$baseUrl2. '');
$frontur  = Yii::getAlias('@frontUr');


?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>Mortgage</strong>
                    <a class="btn btn-success pull-right" href="<?= \yii\helpers\Url::toRoute('mortgage/new') ?>">
                        Add New
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <?php
        if($model)
        {
            ?>
            <ul class="list-group">
                <?php
                foreach($model as $list)
                {
                    $frnd = $list;
                    ?>
                    <li class="list-group-item" >
                        <img src="<?= $front; ?>/images/site/bank/<?= $list['bank_logo'] ?>"  class="img-responsive img-thumbnail">
                        <span style="padding: 5px 10px;display: inline-block">
                                    <strong style="font-size: 18px;color: #555">
                                        <?= $frnd['bank_name']; ?>
                                    </strong><br>
                                    <i style="color: #999">
                                        <?= $frnd['bank_email']; ?>
                                    </i>
                                     <br>
                                    <span style="font-size: 12px;color: #9d9d9d">
                                        <a href="<?= \yii\helpers\Url::toRoute('mortgage/edit/'.$frnd['id']) ?>" style="padding: 10px" role="menuitem" tabindex="-1" class="primary">
                                            Edit
                                        </a>
                                            |
                                        <a href="<?= \yii\helpers\Url::toRoute('mortgage/delete/'.$frnd['id']) ?>" style="padding: 10px" role="menuitem" tabindex="-1" class="primary">
                                            Delete
                                        </a>
                                    </span>
                        </span>
                        <div class="dropdown pull-right">
                            <span style="cursor: pointer;padding: 10px;" class="glyphicon glyphicon-option-vertical dropdown-toggle" id="option1" data-toggle="dropdown"></span>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu" aria-labelledby="option1">
                                <li role="presentation">
                                    <a  style="padding: 10px" data-toggle="modal" data-target="#<?= $frnd['id']; ?>" tabindex="-1" class="primary">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                        View Detail
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="<?= \yii\helpers\Url::toRoute('mortgage/edit/'.$frnd['id']) ?>" style="padding: 10px" role="menuitem" tabindex="-1" class="primary">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                        Edit
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="<?= \yii\helpers\Url::toRoute('mortgage/delete/'.$frnd['id']) ?>" style="padding: 10px" role="menuitem" tabindex="-1" class="primary">
                                        <span class="glyphicon glyphicon-trash"></span>
                                        Delete
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <!-- Modal profile-->
                        <div class="modal fade" id="<?= $frnd['id']; ?>" role="dialog">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><?= $frnd['bank_name']; ?> Detail</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $model = $frnd;
                                        ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="<?= $front; ?>/images/site/bank/<?= $list['bank_logo'] ?>"  class="img-responsive img-thumbnail">
                                            </div>
                                            <div class="col-md-9">
                                                <b>
                                                    <?= $model['bank_name'] ?> :
                                                </b>
                                                <br>
                                                <?= $model['bank_about'] ?>
                                            </div>
                                            <div class="col-lg-12">
                                                <div id="msgboxr"></div>
                                                <div class="panel">
                                                    <div class="panel-body">
                                                        <hr>
                                                        <table class="col-lg-12">
                                                            <tr>
                                                                <td style="text-transform: capitalize">
                                                                    <b>loan purpose</b>
                                                                </td>
                                                                <td>
                                                                    :
                                                                </td>
                                                                <td>
                                                                    <?= $model['loan_purpose'] ?>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td style="text-transform: capitalize">
                                                                    <b>loan product</b>
                                                                </td>
                                                                <td>
                                                                    :
                                                                </td>
                                                                <td>
                                                                    <?= $model['loan_product'] ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-transform: capitalize">
                                                                    <b>interest rate </b>
                                                                </td>
                                                                <td>
                                                                    :
                                                                </td>
                                                                <td>
                                                                    <?= $model['interest_rate'] ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-transform: capitalize">
                                                                    <b>arp</b>
                                                                </td>
                                                                <td>
                                                                    :
                                                                </td>
                                                                <td>
                                                                    <?= $model['arp'] ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-transform: capitalize">
                                                                    <b>loan amount</b>
                                                                </td>
                                                                <td>
                                                                    :
                                                                </td>
                                                                <td>
                                                                    <?= $model['loan_amount'] ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-transform: capitalize">
                                                                    <b>down payment </b>
                                                                </td>
                                                                <td>
                                                                    :
                                                                </td>
                                                                <td>
                                                                    <?= $model['down_payment'] ?>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td style="text-transform: capitalize">
                                                                    <b>total fees / rate lock   </b>
                                                                </td>
                                                                <td>
                                                                    :
                                                                </td>
                                                                <td>
                                                                    <?= $model['total_fees'] ?> / <?= $model['rate_lock'] ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <br>
                                                        <div class="clearfix"></div>
                                                        <hr>
                                                        <b>
                                                            Disclaimer  :
                                                        </b>
                                                        <hr>
                                                        <p>
                                                            <?= $model['disclaimer']; ?>
                                                        </p>
                                                        <hr>
                                                        <br>
                                                        <b>
                                                            note  :
                                                        </b>
                                                        <hr>
                                                        <p>
                                                            <?= $model['note']; ?>
                                                        </p>
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

        }
        else
        {
            echo "<div class='well'><strong>No Mortgage/Bank added in the List</strong> </div>";
        }
        ?>
    </div>
</div>