<?php
$this->title = 'ویرایش ' . $model->title;

$this->params['breadcrumbs'][] = ['label' => 'مطالب', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="well-c">
        <?= $this->render('_form', ['model' => $model]) ?>
    </div>
</div>
