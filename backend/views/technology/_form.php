<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="row">
	<?php $form = ActiveForm::begin();?>
		<?=$form->field($model, 'name')->textInput();?>
		<div class="form-group">
			<?=Html::submitButton($model->isNewRecord ? 'درج' : 'ویرایش', ['class' => $model->isNewRecord ? 'btn btn-block btn-primary' : 'btn btn-block btn-success']);?>
		</div>
	<?php ActiveForm::end();?>
</div>