<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\SubCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent')
        ->dropDownList(\yii\helpers\ArrayHelper::map(common\models\Category::find()->all(),'id','name'),
            ['prompt'=>'Select Main category',

            ])
    ?>
    <?= $form->field($model, 'subcategory_type')->dropDownList(
        [
            'text' => 'Text',
            'textarea' => 'Textarea',
            'select' => 'Select',
            'checkbox' => 'Checkbox',
            'radio' => 'Radio',
            'file' => 'File',
        ],
        [
            'prompt' => '',
            'onchange'=>'forType(this.value)'
        ]) ?>
    <?php
    if($model->input_options != null)
    {
        $data = explode(",",$model->input_options);
        echo "<hr><h6><sub>***</sub> for Delete option value left them blank</h6><hr>";
        foreach($data as $option)
        {
            echo $form->field($model, 'input_options[]')->textInput(['value'=>$option]);
        }
    }
    ?>
    <div id="clonedInput1" class="clonedInput">


       <div>
           <?= $form->field($model, 'input_options[]'); ?>
       </div>
        <div class="actions">
            <button type="button" class="clone btn btn-sm btn-primary">Add More</button>
            <button  type="button" class="remove btn btn-sm btn-info">Remove</button>
        </div>
        <hr>
    </div>
    <div id="more">

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
      function forType(value)
    {
        if(value == "text" || value == "textarea" || value == "file" )
        {
            $('#clonedInput1').hide();

        }
        else
        {
        $('#clonedInput1').show();
        }
    }

    var regex = /^(.+?)(\d+)$/i;
    var cloneIndex = $(".clonedInput").length;

    function clone(){
        $(this).parents(".clonedInput").clone()
            .appendTo("#more")
            .attr("id", "clonedInput" +  cloneIndex)
            .find("*")
            .each(function() {
                var id = this.id || "";
                var match = id.match(regex) || [];
                if (match.length == 3) {
                    this.id = match[1] + (cloneIndex);
                }
            })
            .on('click', 'button.clone', clone)
            .on('click', 'button.remove', remove);
        cloneIndex++;
    }
    function remove(){
        $(this).parents(".clonedInput").remove();
    }
    $("button.clone").on("click", clone);

    $("button.remove").on("click", remove);
JS;
$this->registerJs($script,View::POS_END);
?>
