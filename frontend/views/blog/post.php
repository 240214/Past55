<?php
$this->title = "Write a Blog";
?>
<section class="section">
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-sm-7">
                <div class="card">
                    <div class="card__header">
                        <h2>Write Your Blog</h2>
                        <small>Write as a geust</small>
                    </div>
                    <div class="card__body">
                        <?php $form = \yii\widgets\ActiveForm::begin() ?>
                        <?= $form->field($model,'blog_title')->textInput(['placeholder'=>'eg. Duis mollisest non commodo']) ?>
                        <?= $form->field($model,'blog_image')->fileInput() ?>
                        <hr>
                        <?= $form->field($model,'blog_body')->textarea(['row'=>8,'plaseholder'=>'eg. property Duis mollisest non commodo']) ?>
                        <?= $form->field($model,'blog_tags')->textInput(['plaseholder'=>'eg. property, Home, rent etc'])?>
                        <button type="submit" class="btn btn-success btn-md">Post Blog</button>
                        <?php \yii\widgets\ActiveForm::end()?>
                    </div>
                </div>
            </div>
            <?= $this->render('_aside') ?>
        </div>
    </div>
</section>
