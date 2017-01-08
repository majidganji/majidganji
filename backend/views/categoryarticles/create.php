<?php
use yii\helpers\Html;

$this->title = 'درج دسته بندی جدید';

$this->params['breadcrumbs'][] = ['label' => 'دسته بندی مطالب', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-sm-12 well-c">
        <?= Html::encode($this->title) ?>
    </div>

    <div class="col-sm-5 alert alert-success">
        <?= $this->render('_form', ['model' => $model]) ?>
    </div>
</div>
