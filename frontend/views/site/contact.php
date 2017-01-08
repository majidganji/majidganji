<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'تماس با من';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact well-c">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <div class="col-sm-6">
                <?= $form->field($model, 'name')->textInput(['autofocus' => TRUE]) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'email') ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-2">{image}</div><div class="col-lg-4">{input}</div></div>',
                ]) ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton('ارسال', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
