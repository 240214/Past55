<?php
use common\models\User;
use \yii\bootstrap\ActiveForm;
$this->title = Yii::t('app',  $agent['name'].' Profile');
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
                                <li class="active"><a href="<?= \yii\helpers\Url::toRoute('user/profile/'.$agent['username']) ?>">Overview</a></li>
                                <li ><a href="<?= \yii\helpers\Url::toRoute('user/property/'.$agent['username']) ?>">Properties</a></li>
                                <li><a href="<?= \yii\helpers\Url::toRoute($agent['username'].'/review/') ?>">Reviews</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card__body">
                        <div class="card__sub row rmd-stats">
                            <div class="col-xs-4">
                                <div class="rmd-stats__item mdc-bg-teal-400">
                                    <h2><?= $sold; ?></h2>
                                    <small>Properties Sold</small>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="rmd-stats__item mdc-bg-purple-400">
                                    <h2><?= $listing; ?></h2>
                                    <small>Total Listings</small>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="rmd-stats__item mdc-bg-red-400">
                                    <h2><?= $fvrt; ?></h2>
                                    <small>User Favourites</small>
                                </div>
                            </div>
                        </div>

                        <div class="card__sub">
                            <h4>About <?= $agent['name'] ?></h4>
                            <?= $agent['about'] ?>
                        </div>

                        <div class="card__sub">
                            <h4>Specialties</h4>
                            <p><b>Agent Type :</b> <?= $agent['agent_type'] ?></p>
                            <p><b>Dealing In :</b> <?= $agent['dealing_in'] ?></p>
                            <p><b>Language :</b> <?= $agent['languages'] ?></p>
                            <p><b>Works in Price Range :</b>  <?= $agent['price_min'] ?> - <?= $agent['price_max'] ?></p>

                        </div>


                        <div class="card__sub">
                            <h4>Contact Information</h4>

                            <ul class="rmd-contact-list">
                                <li><i class="zmdi zmdi-phone"></i><?= $agent['mobile'] ?></li>
                                <li><i class="zmdi zmdi-email"></i><?= $agent['email'] ?></li>
                                <li><i class="zmdi zmdi-group"></i><?= $agent['username'] ?></li>
                                <li><i class="zmdi zmdi-pin"></i><?= $agent['address'] ?></li>
                            </ul>
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
