<?php
use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app',  $agent['name'].' Properties');
$this->params['breadcrumbs'][] = $this->title;
?>


<section class="section">
    <div class="container">
        <header class="section__title text-start">
            <h2><?= $agent['name'] ?></h2>
            <small><?= $agent['address'] ?>, <?= $agent['city'] ?></small>

            <div class="actions actions--section">
                <div class="actions__toggle">
                    <input type="checkbox" data-del="<?= \yii\helpers\Url::toRoute('saved/remove-agents/'.base64_encode($agent['id'])) ?>" data-ref="<?= \yii\helpers\Url::toRoute('saved/agents/'.base64_encode($agent['id'])) ?>" agents="<?= $agent['id'] ?>">
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

        <div class="row">
            <div class="col-md-8">
                <div class="card profile">
                    <div class="profile__img">
                        <img src="<?= Yii::getAlias('@web') ?>/images/user/<?= $agent['image'] ?>">
                    </div>

                    <div class="profile__info">
                        <span class="label label-warning">Pro Member</span>
                        <span class="label label-success">Premium Agent</span>

                        <div class="profile__review">
                            <span class="rmd-rate" data-rate-value="<?= $rating['overall'] ?>" data-rate-readonly="true"></span>
                            <span>(<?= ($total_review == 0)?'':$rating['overall'].' rating';?>, <?= $total_review; ?> Review )</span>
                        </div>

                        <ul class="rmd-contact-list">
                            <li><i class="zmdi zmdi-assignment"></i>License Number(s): </li>
                            <li><i class="zmdi zmdi-phone"></i><?= $agent['mobile'] ?></li>
                            <li><i class="zmdi zmdi-email"></i><?= $agent['email'] ?></li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="tab-nav tab-nav--justified" data-rmd-breakpoint="500">
                        <div class="tab-nav__inner">
                            <ul>
                                <li ><a href="<?= \yii\helpers\Url::toRoute('user/profile/'.$agent['username']) ?>">Overview</a></li>
                                <li><a href="<?= \yii\helpers\Url::toRoute('user/property/'.$agent['username']) ?>">Properties</a></li>
                                <li class="active"><a href="<?= \yii\helpers\Url::toRoute($agent['username'].'/review/') ?>">Reviews</a></li>
                            </ul>
                        </div>
                    </div>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <div id="reviewblc" class="card__body hidden">
                            <h2 class="mdc-text-grey-600">
                                Write a review
                            </h2>
                        <hr>


                        <div class="card__sub">
                            <input type="hidden" id="m" value="" name="UserReview[market_knowledge]">
                            <input type="hidden" id="t" value="" name="UserReview[trustworthness]">
                            <input type="hidden" id="r" value="" name="UserReview[resnonsiveness]">
                            <input type="hidden" id="n" value="" name="UserReview[negotiation_skill]">

                            <div class="list-group list-group--bordered list-group--condensed list-group--striped">
                                <div class="media list-group-item">
                                    <div class="pull-right">
                                        <i rated="0" id="m1" style="font-size: 20px" onmouseover="selstar(1,'m')" onmouseout="remstar(1,'m')" onclick="setrate(1,'m')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="m2" style="font-size: 20px" onmouseover="selstar(2,'m')" onmouseout="remstar(2,'m')" onclick="setrate(2,'m')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="m3" style="font-size: 20px" onmouseover="selstar(3,'m')" onmouseout="remstar(3,'m')" onclick="setrate(3,'m')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="m4" style="font-size: 20px" onmouseover="selstar(4,'m')" onmouseout="remstar(4,'m')" onclick="setrate(4,'m')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="m5" style="font-size: 20px" onmouseover="selstar(5,'m')" onmouseout="remstar(5,'m')" onclick="setrate(5,'m')"  class="zmdi zmdi-star mdc-text-grey-300"></i>

                                    </div>
                                    <div class="media-body">
                                        Market knowledge
                                    </div>
                                </div>
                                <div class="media list-group-item">
                                    <div class="pull-right">
                                        <i rated="0" id="t1" style="font-size: 20px" onmouseover="selstar(1,'t')" onmouseout="remstar(1,'t')" onclick="setrate(1,'t')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="t2" style="font-size: 20px" onmouseover="selstar(2,'t')" onmouseout="remstar(2,'t')" onclick="setrate(2,'t')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="t3" style="font-size: 20px" onmouseover="selstar(3,'t')" onmouseout="remstar(3,'t')" onclick="setrate(3,'t')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="t4" style="font-size: 20px" onmouseover="selstar(4,'t')" onmouseout="remstar(4,'t')" onclick="setrate(4,'t')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="t5" style="font-size: 20px" onmouseover="selstar(5,'t')" onmouseout="remstar(5,'t')" onclick="setrate(5,'t')"  class="zmdi zmdi-star mdc-text-grey-300"></i>

                                    </div>
                                    <div class="media-body">
                                        Trustworthness
                                    </div>
                                </div>
                                <div class="media list-group-item">
                                    <div class="pull-right">
                                        <i rated="0" id="r1" style="font-size: 20px" onmouseover="selstar(1,'r')" onmouseout="remstar(1,'r')" onclick="setrate(1,'r')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="r2" style="font-size: 20px" onmouseover="selstar(2,'r')" onmouseout="remstar(2,'r')" onclick="setrate(2,'r')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="r3" style="font-size: 20px" onmouseover="selstar(3,'r')" onmouseout="remstar(3,'r')" onclick="setrate(3,'r')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="r4" style="font-size: 20px" onmouseover="selstar(4,'r')" onmouseout="remstar(4,'r')" onclick="setrate(4,'r')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="r5" style="font-size: 20px" onmouseover="selstar(5,'r')" onmouseout="remstar(5,'r')" onclick="setrate(5,'r')"  class="zmdi zmdi-star mdc-text-grey-300"></i>

                                    </div>
                                    <div class="media-body">
                                        Resnonsiveness
                                    </div>
                                </div>
                                <div class="media list-group-item">
                                    <div class="pull-right">
                                        <i rated="0" id="n1" style="font-size: 20px" onmouseover="selstar(1,'n')" onmouseout="remstar(1,'n')" onclick="setrate(1,'n')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="n2" style="font-size: 20px" onmouseover="selstar(2,'n')" onmouseout="remstar(2,'n')" onclick="setrate(2,'n')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="n3" style="font-size: 20px" onmouseover="selstar(3,'n')" onmouseout="remstar(3,'n')" onclick="setrate(3,'n')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="n4" style="font-size: 20px" onmouseover="selstar(4,'n')" onmouseout="remstar(4,'n')" onclick="setrate(4,'n')"  class="zmdi zmdi-star mdc-text-grey-300"></i>
                                        <i  rated="0"  id="n5" style="font-size: 20px" onmouseover="selstar(5,'n')" onmouseout="remstar(5,'n')" onclick="setrate(5,'n')"  class="zmdi zmdi-star mdc-text-grey-300"></i>

                                    </div>
                                    <div class="media-body">
                                        Negotiation Skill
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?= $form->field($review, 'description')->textarea() ?>

                        <div class="form-group">
                        </div>

                    </div>
                    <div class="card__footer card__footer--highlight ">
                        <?= ($total_review == 0)?"no review yet. Be the first reviwer???":$total_review." people reviwe this agent. you can also write a review below"; ?>
                        <button type="button" id="reviewbtn" class="btn btn-primary pull-right">WRITE A REVIEW</button>
                        <?= Html::submitButton('SUBMIT REVIEW', ['class' => 'pull-right btn btn-primary hidden', 'id'=>'reviewSubmit', 'name' => 'login-button']) ?>

                    </div>
                    <?php ActiveForm::end(); ?>
                    <div id="reviewList" class="card__body <?= ($total_review == 0)?"hidden": $total_review." People review this agent. you can also give "; ?>">
                        <div class="card__sub">
                            <div class="list-group list-group--bordered list-group--condensed list-group--striped">
                                <div class="media list-group-item">
                                    <div class="pull-right">
                                        <div class="rmd-rate" data-rate-value="<?= $rating['market_knowledge'] ?>" data-rate-readonly="true"></div>
                                    </div>
                                    <div class="media-body">
                                        Market knowledge
                                    </div>
                                </div>
                                <div class="media list-group-item">
                                    <div class="pull-right">
                                        <div class="rmd-rate" data-rate-value="<?= $rating['trustworthness'] ?>" data-rate-readonly="true"></div>
                                    </div>
                                    <div class="media-body">
                                        Trustworthness
                                    </div>
                                </div>
                                <div class="media list-group-item">
                                    <div class="pull-right">
                                        <div class="rmd-rate" data-rate-value="<?= $rating['resnonsiveness'] ?>" data-rate-readonly="true"></div>
                                    </div>
                                    <div class="media-body">
                                        Resnonsiveness
                                    </div>
                                </div>
                                <div class="media list-group-item">
                                    <div class="pull-right">
                                        <div class="rmd-rate" data-rate-value="<?= $rating['negotiation_skill'] ?>" data-rate-readonly="true"></div>
                                    </div>
                                    <div class="media-body">
                                        Negotiation Skill
                                    </div>
                                </div>
                                <div class="media list-group-item">
                                    <div class="pull-right">
                                        <div class="rmd-rate" data-rate-value="<?= $rating['overall'] ?>" data-rate-readonly="true"></div>
                                    </div>
                                    <div class="media-body">
                                       Overall
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card__sub ">
                            <h4><?= $total_review; ?> User reviews</h4>

                            <?php
                            foreach ($reviews as $reviewList)
                            {
                            ?>
                            <div class="agent-reviews__item">
                                <div class="text-strong">By <?= $reviewList['name'] ?> on <?= date("d-m-Y",$reviewList['review_at']); ?></div>
                                <div class="rmd-rate" data-rate-value="<?= $reviewList['overall'] ?>" data-rate-readonly="true"></div>

                                <p><?= $reviewList['description'] ?></p>
                            </div>
                            <?php
                            }
                            ?>


                        </div>

                        <div class="load-more hidden">
                            <a href="#"><i class="zmdi zmdi-refresh-alt"></i> Load more reviews</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4 rmd-sidebar-mobile" id="agent-question">
                <div class="card">
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <div class="card__header">
                        <h2>Ask a Question</h2>
                        <small>Aeneanquam ellentesque ornare lacinia venenatis</small>
                    </div>

                    <div class="card__body m-t-10">
                        <div class="form-group form-group--float">
                            <input type="text" name="ContactForm[name]"  class="form-control">
                            <i class="form-group__bar"></i>
                            <label>Name</label>
                        </div>
                        <div class="form-group form-group--float">
                            <input name="ContactForm[email]" type="text" class="form-control">
                            <i class="form-group__bar"></i>
                            <label>Email Address</label>
                        </div>
                        <div class="form-group form-group--float">
                            <input name="ContactForm[subject]" type="text" class="form-control">
                            <i class="form-group__bar"></i>
                            <label>Subjecct</label>
                        </div>
                        <div class="form-group form-group--float">
                            <textarea name="ContactForm[body]" class="form-control textarea-autoheight"></textarea>
                            <i class="form-group__bar"></i>
                            <label>Message</label>
                        </div>

                        <small class="text-muted">By sending us your information, you agree to Root’s Terms of Use & Privacy Policy.</small>
                    </div>

                    <div class="card__footer">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-sm btn-link">Reset</button>
                        <button class="btn btn-sm btn-link d-md-none d-inline" data-rmd-action="block-close" data-rmd-target="#agent-question">Cancel</button>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Button for mobile -->
<button class="btn btn--action btn--circle d-md-none" data-rmd-action="block-open" data-rmd-target="#agent-question">
    <i class="zmdi zmdi-comment-alt-text"></i>
</button>





<!-- Contact Agent Modal -->
