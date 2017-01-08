<?php

use backend\models\Categories;
use yii\helpers\Html;
use yii\helpers\Url;
$category[null] = '';
foreach (Categories::find()->all() as $cate){
    $category[$cate->id] = $cate->name;
}
?>
<div class="alert alert-success">
    <h4>جستجو</h4>
    <hr>
    <?=Html::beginForm(['search'], 'get');?>
    <div class="form-group">
        <label for="id">ردیف:</label>
        <?=Html::input('text', 'id', null, ['class' => 'form-control', 'id' => 'id']);?>
    </div>
    <div class="form-group">
        <label for="name">عنوان:</label>
        <?=Html::input('text', 'title', null, ['class' => 'form-control', 'id' => 'name']);?>
    </div>
    <div class="form-group">
        <label for="slug">نویسنده:</label>
        <?=Html::input('text', 'editor', null, ['class' => 'form-control', 'id' => 'slug']);?>
    </div>
    <div class="form-group">
        <label for="slug">دسته بندی:</label>
        <?=Html::dropDownList('category', null, $category, ['class' => 'form-control', 'id' => 'slug']);?>
    </div>
    <div class="form-group">
        <label for="slug">وضیعت:</label>
        <?=Html::dropDownList('status', '',[null => '', 0 => 'غیر فعال', 10 => 'فعال'], ['class' => 'form-control', 'id' => 'slug']);?>
    </div>
    <div class="form-group">
        <?=Html::submitButton('جستجو', ['class' => 'btn btn-default']);?>
        <a href="<?=Url::to(['index']);?>" class="btn btn-default">لیست کامل</a>
    </div>
    <?=Html::endForm();?>
</div>