<?php
use dosamigos\tinymce\TinyMce;
?>
<div class="row">
	<div class="col-md-12">
		<?=$form->field($model, 'pet_policy')->widget(TinyMce::className(), Yii::$app->params['tinymce']);?>
	</div>
</div>


