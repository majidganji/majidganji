<?php
    use yii\helpers\Html;
?>

<div class="row" style="margin-top: 20px;">
    <div class="col-sm-5 well">
        <?= Html::beginForm(['search'], 'get'); ?>
        <div class="form-group">
            <?= Html::label('ردیف', 'id', ['class' => 'control-label']) ?>
            <?= Html::input('text', 'id', null, ['class' => 'form-control']) ?>
        </div>
        <div class="form-group">
            <?= Html::label('نام', 'name', ['class' => 'control-label']) ?>
            <?= Html::input('text', 'name', null, ['class' => 'form-control']) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('جستجو', ['class' => 'btn btn-primary']) ?>
        </div>
        <?= Html::endForm(); ?>
    </div>
</div>
