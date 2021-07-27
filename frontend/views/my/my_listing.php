<?php
use common\models\User;
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
                        <li class="active"><a href="<?= \yii\helpers\Url::toRoute('my/listing') ?>">My Listings</a></li>

                        <li><a href="<?= \yii\helpers\Url::toRoute('my/search') ?>">My Searches</a></li>
                        <li ><a href="<?= \yii\helpers\Url::toRoute('my/saved/property') ?>">Saved Listings</a></li>
                        <li><a href="<?= \yii\helpers\Url::toRoute('my/saved/agents') ?>">Saved Agents</a></li>
                    </ul>
                </div>
            </div>
            <div class="listings-list listings-list--alt">
                <?php
                foreach ($listing as $ads)
                {
                    ?>
                    <div class="listings-grid__item <?= ($ads['sold']=='yes')?"listings-grid__item--sold":""; ?>">
                        <a href="<?= \yii\helpers\Url::toRoute('property/view/'.base64_encode($ads['id'])) ?>" class="media">
                            <div class="listings-grid__main pull-left">
                                <img src="<?= Yii::getAlias('@web') ?>/images/property/cover/<?=  $ads['image'] ?>" alt="">
                                <div class="listings-grid__price">$ <?=  $ads['price'] ?></div>
                            </div>

                            <div class="media-body">
                                <div class="listings-grid__body">
                                    <small><?=  $ads['address'] ?></small>
                                    <h5><?=  $ads['title'] ?></h5>
                                </div>
                                <ul class="listings-grid__attrs">
                                    <li><i class="listings-grid__icon listings-grid__icon--bed"></i> <?=  $ads['bedrooms'] ?></li>
                                    <li><i class="listings-grid__icon listings-grid__icon--bath"></i> <?=  $ads['bathrooms'] ?></li>
                                    <li><i class="listings-grid__icon listings-grid__icon--parking"></i> <?=  $ads['parking'] ?></li>
                                </ul>
                            </div>
                        </a>
                    </div>
                    <?php

                }
                ?>

            </div>
            <div class="list-group m-t-20">
                <?php
                if(!$listing)
                {
                   ?>
                    <div class="card__body">
                        <blockquote style="border-color: #8eff3b">
                            No Post yet. please submit a listing.
                            <footer><i>Thank you</i></footer>
                        </blockquote>
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



