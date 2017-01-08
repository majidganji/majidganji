<?php
use yii\helpers\Html;

$this->title = 'ایجاد مطلب جدید';

    $this->params['breadcrumbs'][] = ['label' => 'مطالب', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="well-c">
    <h4><?= Html::encode($this->title) ?></h4>
</div>

<div class="row">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
