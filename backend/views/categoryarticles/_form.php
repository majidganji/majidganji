<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name') ?>

<?= $form->field($model, 'slug') ?>

    <div class="form-group">
        <?= Html::submitButton(($model->isNewRecord ? 'درج' : 'ویرایش'), ['class' => 'btn btn-' . ($model->isNewRecord ? 'success ': 'warning')]) ?>
    </div>

<?php ActiveForm::end(); ?>