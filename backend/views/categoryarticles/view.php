<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->name;

$this->params['breadcrumbs'][] = ['label' => 'دسته بندی مطالب', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-sm-12 well-c">
        <p>
            <a href="<?= Url::to(['edit', 'id' => $model->id]) ?>" class="btn btn-warning">ویرایش</a>
            <a href="<?= Url::to(['delete', 'id' => $model->id]) ?>" class="btn btn-danger" onclick="return confirm('آیا حذف شود؟')">حذف</a>
        </p>
        <table class="table table-responsive table-hover table-striped table-bordered">
            <tr>
                <th>ID:</th>
                <td><?= Html::encode($model->id) ?></td>
            </tr>
            <tr>
                <th>نام:</th>
                <td><?= Html::encode($model->name) ?></td>
            </tr>
            <tr>
                <th>مسیر:</th>
                <td><?= Html::encode($model->slug) ?></td>
            </tr>
        </table>
    </div>
</div>
