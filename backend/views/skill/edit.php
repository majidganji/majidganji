<?php
    $this->title = 'ویرایش ' . $model->name;

    $this->params['breadcrumbs'][] = ['label' => 'مهارت های من', 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
    $this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', ['model' => $model]) ?>
