<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Agents List');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="row">
                    <div class="col-md-4">
                        <div id="sidebar">
                            <div class="card">
                                <h4>Search Agents <br>
                                    <small>Save the hassle. Choose from over 20,000+ Agents</small>
                                </h4>
                                <?php $form = ActiveForm::begin(['id' => 'agent-search-form']); ?>

                                <?= $form->field($findAgents, 'city')
                                    ->textInput(['placeholder'=>'Enter Location, city,landmark..'])->label('Enter Location, landmark.')
                                ?>

                                <?= $form->field($findAgents, 'deal_property_type')->dropDownList(
                                    ArrayHelper::map(common\models\Category::find()->all(),'id','name'),
                                    [
                                        'prompt'=>'Select property type',
                                    ])
                                ?>

                                <?= $form->field($findAgents, 'dealing_in')->dropDownList(
                                    ['sale'=>'For Sale','rent'=>'for rent'],
                                    [
                                        'prompt'=>'select deal',
                                    ])
                                ?>

                                <?= Html::submitButton(Yii::t('app', 'Find Agents'), ['class' =>  'btn btn-md  btn-primary']) ?>

                                <?php ActiveForm::end(); ?>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h1 class="page-header"><?= $this->title; ?></h1>

                        <div class="clearfix"></div>
                        <div class="item-listing list">
                            <?php
                            foreach($agents as $agent)
                            {
                                ?>
                                <div class="item" data-aos="fade-up">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="item-image">
                                                <img src="<?= Yii::getAlias('@web') ?>/images/user/<?= $agent['image'] ?> " class="img-responsive">
                                            </div>
                                            <div class="added-on">
                                                Member since <?= date("Y",$agent['created_at']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <a href="<?= \yii\helpers\Url::toRoute('user/u/'.$agent['username']) ?>" class="btn btn-primary pull-right">
                                                View Profile
                                            </a>
                                            <h3 class="item-title">
                                                <a href="<?= \yii\helpers\Url::toRoute('user/u/'.$agent['username']) ?>">
                                                    <?= $agent['name'] ?> - <?= $agent['username'] ?>
                                                </a>
                                            </h3>
                                            <div class="item-location">
                                                <?= $agent['address'] ?>
                                            </div>
                                            <div class="item-description">
                                                <?= $agent['about'] ?>

                                            </div>
                                            <div class="item-actions">
                                                <a href="tel:<?= $agent['mobile'] ?>">
                                                    <i class="fa fa-phone"></i>
                                                    <?= $agent['mobile'] ?>
                                                </a>
                                                <a href="#">
                                                    <i class="fa fa-envelope-o"></i> Contact Agent
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>

                        </div>
                        <p><a href="#" class="btn btn-lg btn-link btn-block">Load More <i class="fa fa-caret-down"></i></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
