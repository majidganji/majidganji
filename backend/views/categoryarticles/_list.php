<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<table class="table table-striped table-responsive table-hover">
    <tr>
        <th>ID</th>
        <th>نام</th>
        <th>مسیر</th>
        <th class="col-sm-1">&nbsp;</th>
    </tr>
    <?php if(empty($models)): ?>
        <tr class="alert-danger">
            <td colspan="4">دسته‌بندی وجود ندارد.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($models as $model): ?>
            <tr>
                <td><a href="<?= Url::to(['categoryarticles/view', 'id' => $model->id]) ?>"><?= Html::encode($model->id) ?></a></td>
                <td><?= Html::encode($model->name) ?></td>
                <td><?= Html::encode($model->slug) ?></td>
                <td>
                    <a href="<?= Url::to(['categoryarticles/view', 'id' => $model->id]) ?>" class="text-info">
                        <span class="fa fa-eye"></span>
                    </a>
                    &nbsp;
                    <a href="<?= Url::to(['categoryarticles/edit', 'id' => $model->id]) ?>" class="text-warning">
                        <span class="fa fa-edit"></span>
                    </a>
                    &nbsp;
                    <a href="<?= Url::to(['categoryarticles/delete', 'id' => $model->id]) ?>" class="text-danger"
                       onclick="return confirm('آیا حذف شود؟')">
                        <span class="fa fa-times"></span>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

        <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
    <?php endif; ?>
</table>