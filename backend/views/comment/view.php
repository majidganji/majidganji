<?php

use backend\models\Comment;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'نظرات', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

    <h3 class="well-c"><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a(Yii::t('app', 'ویرایش'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'حذف'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'آیا می خواهید حذف شود؟',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <table class="table well-c table-responsive table-bordered table-striped table-hover">
        <tr>
            <th>ID</th>
            <td><?= Html::encode($model->id) ?></td>
        </tr>
        <tr>
            <th>مطلب</th>
            <td>
                <a href="<?= Url::to(['articles/view', 'id' => $model->post_id]) ?>"
                   target="_blank"><?= Html::encode($model->post->title) ?></a>
            </td>
        </tr>
        <tr>
            <th>والد</th>
            <?php if (empty($model->parent_id)): ?>
                <td>والد ندارد.</td>
            <?php else: ?>
                <td>
                    <p>
                        <a href="<?= Url::to(['view', 'id' => $model->parent_id]) ?>"
                           target="_blank"><?= Html::encode($model->parent->name) ?></a>
                    </p>
                    <p>
                        <?= Html::encode($model->parent->body) ?>
                    </p>
                </td>
            <?php endif; ?>
        </tr>
        <tr>
            <th>نام</th>
            <td><?= Html::encode($model->name) ?></td>
        </tr>
        <tr>
            <th>پست الکترونیکی</th>
            <td><?= Html::encode($model->email) ?></td>
        </tr>
        <tr>
            <th>وب سایت</th>
            <td>
                <?= Html::encode($model->website) ?>
            </td>
        </tr>
        <tr>
            <th>نظر</th>
            <td><?= Html::encode($model->body) ?></td>
        </tr>
        <tr>
            <th>زمان</th>
            <td><?= Yii::$app->jdf->jdate('H:i , l j F Y', $model->ts) ?></td>
        </tr>
        <tr>
            <th>وضعیت</th>
            <td><?= $model->status ? 'فعال' : 'غیرفعال' ?></td>
        </tr>
    </table>
</div>
<?php if (empty($model->parent_id)): ?>
<div class="row col-sm-5 well-c">
    <h4 class="well-c">پاسخ</h4>
    <?= Html::beginForm(['answer'], 'post') ?>
    <input type="hidden" value="<?= Yii::$app->security->hashData($model->id, 'uashdn/*ada5d1') ?>" name="parent">
    <div class="form-group">
        <?= Html::label('نظر') ?>
        <?= Html::textarea('body', '', ['rows' => 6, 'style' => 'resize:none;', 'class' => 'form-control', 'required' => 'required']) ?>
    </div>
    <div class="form-group">
        <?= Html::label('وضعیت'); ?>
        <?= Html::dropDownList('status', null, [10 => 'فعال', 0 => 'غیر فعال'], ['class' => 'form-control', 'required' => 'required']) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('ارسال', ['class' => 'btn btn-success']) ?>
    </div>
    <?= Html::endForm() ?>
</div>
<?php endif; ?>
<div class="row col-sm-7 well-c">
    <h4 class="well-c">پاسخ ها</h4>
    <?php foreach (Comment::findAll(['parent_id' => $model->id]) as $subComment): ?>
        <table class="table well-c table-responsive table-bordered table-striped table-hover">
            <tr>
                <th>ID</th>
                <td><a href="<?= Url::to(['view', 'id' => $subComment->id]) ?>" target="_blank"><?= Html::encode($subComment->id) ?></a></td>
            </tr>
            <tr>
                <th>نام</th>
                <td><?= Html::encode($subComment->name) ?></td>
            </tr>
            <tr>
                <th>نظر</th>
                <td><?= Html::encode($subComment->body) ?></td>
            </tr>
            <tr>
                <th>زمان</th>
                <td><?= Yii::$app->jdf->jdate('H:i , l j F Y', $model->ts) ?></td>
            </tr>
            <tr>
                <th>وضعیت</th>
                <td><?= $subComment->status ? 'فعال' : 'غیرفعال' ?></td>
            </tr>
        </table>
    <?php endforeach; ?>
</div>
