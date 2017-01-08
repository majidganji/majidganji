<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<div class="comment-search">

    <?= Html::beginForm(['search'], 'get') ?>

    <div class="form-group">
        <?= Html::label('ID') ?>
        <?= Html::input('text', 'id', null, ['class' => 'form-control']) ?>
    </div>
    <div class="form-group">
        <?= Html::label('مطلب'); ?>
        <?= Html::input('text', 'post', null, ['class' => 'form-control']) ?>
    </div>
    <div class="form-group">
        <?= Html::label('نام'); ?>
        <?= Html::input('text', 'name', null, ['class' => 'form-control']) ?>
    </div>
    <div class="form-group">
        <?= Html::label('والد'); ?>
        <?= Html::input('text', 'parent', null, ['class' => 'form-control']) ?>
    </div>
    <div class="form-group">
        <?= Html::label('وضعیت'); ?>
        <?= Html::dropDownList('status', null, [null => '', 0 => 'غیر فعال', 10 => 'فعال'], ['class' => 'form-control']) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('جستجو', ['class' => 'btn btn-default']) ?>
        &nbsp;
        <a href="<?= Url::to(['index']) ?>">لغو</a>
    </div>
    <?= Html::endForm(); ?>
</div>
