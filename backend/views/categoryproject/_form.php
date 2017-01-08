<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin();?>
	<?=$form->field($model, 'name')->textInput();?>
	<div class="form-group">
		<?=Html::submitButton($model->isNewRecord ? 'درج' : 'ویرایش', ['class' => $model->isNewRecord ? 'btn btn-info' : 'btn btn-success']);?>
	</div>
<?php ActiveForm::end();?>


<?php
$script = <<<js
	$('#slug').keyup(function(){
		var value = $(this).val();
		$(this).val(value.replace(/ /g, '-').replace(/-{2,}/g, '-'));
	});
js;

$this->registerJs($script);
?>