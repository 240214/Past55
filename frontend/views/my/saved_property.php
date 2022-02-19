<?php
use common\models\Users;
use \yii\bootstrap\ActiveForm;
$this->title = Yii::t('app',  $agent['name'].' saved property listing');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="section">
    <div class="container container--sm">
        <header class="section__title text-start">
            <h2><?= $agent['name'] ?></h2>
            <small><?= $agent['address'] ?>, <?= $agent['city'] ?></small>

            <div class="actions actions--section">
                <div class="actions__toggle">
                    <input type="checkbox">
                    <i class="zmdi zmdi-favorite-outline"></i>
                    <i class="zmdi zmdi-favorite"></i>
                </div>

                <div class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="zmdi zmdi-share"></i></a>

                    <div class="dropdown-menu pull-right rmd-share">
                        <div></div>
                    </div>
                </div>
            </div>
        </header>

        <div class="clearfix"></div>

        <div class="card profile">
            <div class="profile__img">
                <img src="<?= Yii::getAlias('@web') ?>/images/user/<?= $agent['image'] ?>">
            </div>

            <div class="profile__info">
                <span class="label label-warning <?= ($agent['role'] == 'agent')?'hidden':'' ?>">Pro Member</span>
                <span class="label label-success <?= ($agent['role'] == 'agent')?'':'hidden' ?>">Premium Agent</span>

                <div class="profile__review">
                    <span class="rmd-rate" data-rate-value="<?= $rating['overall'] ?>" data-rate-readonly="true"></span>
                    <span>(<?= ($total_review == 0)?'':$rating['overall'].' rating';?>, <?= $total_review; ?> Review )</span>
                </div>

                <ul class="rmd-contact-list">
                    <li><i class="zmdi zmdi-assignment"></i>License Number(s): </li>
                    <li><i class="zmdi zmdi-phone"></i><?= ($agent['mobile'])?$agent['mobile']:"xxxx-Not-Given-xxx" ?></li>
                    <li><i class="zmdi zmdi-email"></i><?= $agent['email'] ?></li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="tab-nav tab-nav--justified" data-rmd-breakpoint="650">
                <div class="tab-nav__inner">
                    <ul>
                        <li ><a href="<?= \yii\helpers\Url::toRoute('my/profile') ?>">Overview</a></li>
                        <li><a href="<?= \yii\helpers\Url::toRoute('my/listing') ?>">My Listings</a></li>

                        <li><a href="<?= \yii\helpers\Url::toRoute('my/search') ?>">My Searches</a></li>
                        <li class="active"><a href="<?= \yii\helpers\Url::toRoute('my/saved/property') ?>">Saved Listings</a></li>
                        <li><a href="<?= \yii\helpers\Url::toRoute('my/saved/agents') ?>">Saved Agents</a></li>
                    </ul>
                </div>
            </div>

            <div class="list-group m-t-20">
                <?php
                if(!$saved)
                {
                    ?>
                    <div class="card__body">
                        <blockquote style="border-color: #8eff3b">
                            there is Nothing to show. its seem like you never like any <b>Property</b> yet!!!
                            <footer><i>Thank you</i></footer>
                        </blockquote>
                    </div>
                    <?php
                }
                foreach ($saved as $list)
                {
                    ?>
                    <div id="savedList<?=  $list['id']; ?>" class="list-group__wrap">
                        <a href="<?= \yii\helpers\Url::toRoute('property/view/'.base64_encode($list['id'])) ?>" class="list-group-item media">
                            <div class="pull-left">
                                <img src="<?= Yii::getAlias('@web') ?>/images/property/cover/<?=  $list['image']; ?>" alt="" class="list-group__img" width="65">
                            </div>
                            <div class="media-body list-group__text">
                                <strong><?=  $list['title']; ?></strong>
                                <small>$<?=  $list['price']; ?> . <?=  $list['bedrooms']; ?> Beds . <?=  $list['bathrooms']; ?> Baths</small>
                            </div>
                        </a>
                        <div class="actions list-group__actions">
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                                <ul class="dropdown-menu pull-right">
                                    <li><a href="<?= \yii\helpers\Url::toRoute('property/view/'.base64_encode($list['id'])) ?>">View</a></li>
                                    <li><a class="remSaveProp" data-val="<?=  $list['id']; ?>" data-del="<?= \yii\helpers\Url::toRoute('saved/remove-property/'.base64_encode($list['id'])) ?>" href="javascript:void()">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>


<!-- Contact Button for mobile -->
<button class="btn btn--action btn--circle d-md-none" data-rmd-action="block-open" data-rmd-target="#agent-question">
    <i class="zmdi zmdi-comment-alt-text"></i>
</button>



