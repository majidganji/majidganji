<?php
$this->title = 'ویرایش ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'دسته بندی مطالب', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-sm-5 alert alert-warning">
        <?= $this->render('_form', ['model' => $model]) ?>
    </div>
</div>
