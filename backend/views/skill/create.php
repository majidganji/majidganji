<?php
    $this->title = 'درج مهارت جدید';

    $this->params['breadcrumbs'][] = ['label' => 'مهارت های من', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<h3 class="well-c"><?= encode($this->title) ?></h3>

<?= $this->render('_form', ['model' => $model]) ?>
