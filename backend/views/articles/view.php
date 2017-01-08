<?php
    use yii\helpers\Url;
    use yii\helpers\Html;

    $this->title = $model->title;

    $this->params['breadcrumbs'][] = ['label' => 'مطالب', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="row well-c">
    <h4><?= Html::encode($model->title) ?></h4>
</div>

<div class="row well-c">
    <div class="col-sm-12">
        <a href="<?= Url::to(['edit', 'id' => $model->id]) ?>" class="btn btn-success">ویرایش</a>
        <a href="<?= Url::to(['delete', 'id' => $model->id]) ?>" class="btn btn-danger" onclick="return confirm('آیا حذف شود؟')">حذف</a>
    </div>
    <div class="col-sm-12"  style="margin-top: 15px;">

    <table class="table table-responsive table-striped table-condensed table-hover">
        <tr>
            <th>ID</th>
            <td><?= Html::encode($model->id) ?></td>
        </tr>
        <tr>
            <th>نویسنده</th>
            <td><?= Html::encode($model->editor->username) ?></td>
        </tr>
        <tr>
            <th>دسته بندی</th>
            <td><?= Html::encode($model->category->name) ?></td>
        </tr>

        <tr>
            <th>عنوان</th>
            <td><?= Html::encode($model->title) ?></td>
        </tr>
        <tr>
            <th>متن</th>
            <td><?= ($model->body) ?></td>
        </tr>
        <tr>
            <th>مسیر</th>
            <td><?= Html::encode($model->slug) ?></td>
        </tr>
        <tr>
            <th>تصویر</th>
            <td>
                <img class="col-sm-4 img-responsive" src="<?= Yii::$app->request->baseUrl ?>/../photos/<?= $model->image ?>" alt="<?= $model->title ?>">
            </td>
        </tr>
        <tr>
            <th>وضعیت</th>
            <td><?= $model->status ? 'فعال' : 'غیر فعال' ?></td>
        </tr>
        <tr>
            <th>زمان درج</th>
            <td><?= Yii::$app->jdf->jdate('l j F y', $model->created_at) ?></td>
        </tr>
    </table>
    </div>
</div>


