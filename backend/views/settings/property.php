<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Google Adsense setting';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login ">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-body">
                    <blockquote>
                        <h2>
                            Google Adsense
                        </h2>
                        <small>Pull Your Google Adsense code here</small>
                    </blockquote>
                    <blockquote>
                        <h2>
                           added in new new version
                        </h2>
                        <small>This feature is not available in this version</small>
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="col-lg-5 hidden-lg">
            <div class="panel panel-piluku">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                    <?= $form->field($model, 'code')->textInput()->label('Google Adsense script') ?>
                    <?= $form->field($model, 'status')->radioList(['0'=>"active",'1'=>"disable"]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'site-settings-button']) ?>

                    </div>

                    <?php ActiveForm::end(); ?>
                    <!-- /row -->
                </div>
            </div>

        </div>

        <div class="col-lg-7 hidden-lg">
            <div class="panel">
                <div class="panel-body">
                    <blockquote>
                        <h2>
                            Your property preview
                        </h2>
                    </blockquote>

                    <div style="width: 350px;">
                        <?php //$list['code'] ?>
                        <script async="async" src="https://www.google.com/adsense/search/ads.js"></script>

                        <!-- other head elements from your page -->

                        <script type="text/javascript" charset="utf-8">
                            (function(g,o){g[o]=g[o]||function(){(g[o]['q']=g[o]['q']||[]).push(
                                arguments)},g[o]['t']=1*new Date})(window,'_googCsa');
                        </script>

	                    <?php /*
                        <script async="async" src="https://www.google.com/adsense/search/ads.js"></script>

                        <!-- other head elements from your page -->

                        <script type="text/javascript" charset="utf-8">
                            (function(g,o){g[o]=g[o]||function(){(g[o]['q']=g[o]['q']||[]).push(
                                arguments)},g[o]['t']=1*new Date})(window,'_googCsa');
                        </script>
						*/?>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
