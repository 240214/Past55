<?php
use common\models\Users;

$this->title = Yii::t('app', 'All Registered Agent');
$this->params['breadcrumbs'][] = $this->title;
?>



<section class="section">
    <div class="container">
        <header class="section__title">
            <h2> Agent List from our community </h2>
            <small>
                Authorised agents showing below. Please check all detail about the agents before any deal
            </small>
        </header>

        <div class="row listings-grid">
            <?php

            foreach ($agent as $list)
            {
            ?>
            <div class="col-sm-6 col-md-3">
                <div class="listings-grid__item">
                    <a href="<?= \yii\helpers\Url::toRoute('user/profile/'.$list['username']) ?>">
                        <div class="listings-grid__main">
                            <img src="<?= Yii::getAlias('@web') ?>/images/user/<?= $list['image']; ?>" alt="">
                        </div>
                        <div class="listings-grid__body">
                            <h5><?= $list['city']; ?>, <?= $list['country']; ?></h5>
                            <small><?= $list['email']; ?></small>
                            <small><?= ($list['mobile'])?$list['mobile']:"Not available"; ?></small>
                        </div>

                        <ul class="listings-grid__attrs">
                            <li class="rmd-rate" data-rate-value="<?= \common\models\UserRating::getRating($list['id']) ?>" data-rate-readonly="true"></li>
                        </ul>
                    </a>

                    <div class="actions listings-grid__favorite">
                        <div class="actions__toggle">
                            <input type="checkbox" data-del="<?= \yii\helpers\Url::toRoute('saved/remove-agents/'.base64_encode($list['id'])) ?>" data-ref="<?= \yii\helpers\Url::toRoute('saved/agents/'.base64_encode($list['id'])) ?>" agents="<?= $list['id'] ?>">
                            <i class="zmdi zmdi-favorite-outline"></i>
                            <i class="zmdi zmdi-favorite"></i>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }


            if(!$agent)
            {
            $class = "show";
            }
            else
            {
            $class = "hidden";
            }
            ?>
            <!--  loop content end-->
            <div  class="content_list col-md-12 <?= $class; ?>" align="center">
                <div class="card">
                    <div class="card__body">
                        <h2 class="mdc-text-grey">
                            Zero Result Found
                        </h2>
                        <h6 class="mdc-text-grey-400">
                            Change Search criteria or try new category
                        </h6>
                        <br>
                        <br><br>
                        <span> ---- AND ----- </span>
                        <br>
                        <div class="load-more">
                            <a onclick="window.location.reload()"><i class="zmdi zmdi-refresh-alt"></i> Refresh the page.</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="load-more hidden">
            <a href="#"><i class="zmdi zmdi-refresh-alt"></i> Load more Agents</a>
        </div>
    </div>
</section>

<!-- Advanced Agents Search -->
<button class="btn btn--action btn--circle" data-rmd-action="block-open" data-rmd-target="#agent-search">
    <i class="zmdi zmdi-search-for"></i>
</button>

<aside id="agent-search" class="rmd-sidebar">
    <?php $form = \yii\widgets\ActiveForm::begin(); ?>
        <div class="card__header">
            <h2>Advanced Agent Search</h2>
        </div>
        <div class="card__body">
            <div class="form-group">
                <label>Looking for (Agents)</label>
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn active">
                        <input type="radio" name="SearchAgentsForm[role]" value="null " checked > All
                    </label>
                    <label class="btn ">
                        <input type="radio" name="SearchAgentsForm[role]" value="agent " checked >Agent
                    </label>
                    <label class="btn">
                        <input type="radio" name="SearchAgentsForm[role]" value="guest">Owner
                    </label>

                </div>
            </div>
            <div class="form-group  required">
                <?= $form->field($search, 'location', ['options'=>['class'=> 'form-group form-group--float'],'template'=>" {input}\n {label} \n <i class='form-group__bar'></i> \n {hint} \n {error}"])->textInput(['options'=>['placeholder'=>'Subject']]); ?>
            </div>
            <div class="form-group  required">
                <?= $form->field($search, 'agent_type', ['options'=>['class'=> 'form-group']])
                    ->dropDownList([
                        'Agents' => 'Agents',
                        'Brokers' => 'Brokers',
                        'Mortgage Lenders'=>'Mortgage Lenders',
                        'Developers'=>'Developers',
                        'Buiders'=>'Buiders'
                    ],['class'=>'select2']); ?>


            </div>


            <div class="form-group form-group--range">
                <label>Works in Price Range</label>
                <div class="input-slider-values clearfix">
                    <div class="pull-left">
                        <span>$</span>
                        <input  name="SearchAgentsForm[price_min]" id="property-price-min" value="" type="hidden" />
                        <input  name="SearchAgentsForm[price_max]" id="property-price-max" value="" type="hidden" />

                        <span  id="property-price-upper"></span>
                    </div>
                    <div class="pull-right">
                        <span>$</span>
                        <span id="property-price-lower"></span>
                    </div>
                </div>
                <div id="property-price-range" onmouseout="$('#property-price-min').val($('#property-price-upper').text());$('#property-price-max').val($('#property-price-lower').text())"></div>
            </div>

            <?= $form->field($search, 'languages', ['options'=>['class'=> 'form-group']])
                ->dropDownList([
                    'English' => 'English',
                    'Spanish' => 'Spanish',
                    'French'=>'French',
                    'Russian'=>'Russian',
                    'Hindi'=>'Hindi'
                ],['class'=>'select2','multiple'=>'multiple']); ?>
        </div>

        <div class="card__footer">
            <button type="submit" class="btn btn-sm btn-primary">Search</button>
            <a href="#" class="btn btn-sm btn-link" data-rmd-action="block-close" data-rmd-target="#agent-search">Cancel</a>
        </div>

    <?php \yii\widgets\ActiveForm::end(); ?>
</aside>
