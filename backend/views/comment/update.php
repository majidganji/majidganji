<?php

use yii\helpers\Html;

$this->title = 'ویرایش: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="comment-update">

    <h3 class="well-c"><?= Html::encode($this->title) ?></h3>

    <div class="col-sm-5 well-c">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
