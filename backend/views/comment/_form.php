<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <label for="parent">والد</label>
        <a href="<?= Url::to(['view', 'id' => $model->parent_id]) ?>" class="form-control"><?= Html::encode($model->parent->name) ?></a>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([0 => 'غیر فعال', 10 => 'فعال']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'درج' : 'ویرایش', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
