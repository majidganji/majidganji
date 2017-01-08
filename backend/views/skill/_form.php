<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(); ?>
<div class="col-sm-6">
    <div class="well-c">
        <?= $form->field($model, 'name') ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'درج' : 'ویرایش', ['class' => $model->isNewRecord ? 'btn btn-block btn-success' : 'btn btn-block btn-warning']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
