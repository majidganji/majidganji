<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<div class="row">
    <div class="col-sm-12">
        <table class="table table-responsive table-hover table-striped table-condensed">
            <tr>
                <th>ID</th>
                <th>عنوان</th>
                <th>نویسنده</th>
                <th>دسته بندی</th>
                <th>وضعیت</th>
                <th class="col-sm-1">&nbsp;</th>
            </tr>
            <?php if (empty($models)): ?>
                <tr class="alert-danger">
                    <td colspan="6">مطلبی وجود ندارد.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($models as $model): ?>
                    <tr>
                        <td><a href="<?= Url::to(['view', 'id' => $model->id]) ?>"><?= $model->id ?></a></td>
                        <td><?= Html::encode($model->title) ?></td>
                        <td><?= Html::encode($model->editor->username) ?></td>
                        <td><?= Html::encode($model->category->name) ?></td>
                        <td><?= ($model->status ? 'فعال' : 'غیر فعال') ?></td>
                        <td>
                            <a href="<?= Url::to(['view', 'id' => $model->id]) ?>" class="text-info"><span
                                        class="fa fa-eye"></span></a>
                            &nbsp;
                            <a href="<?= Url::to(['edit', 'id' => $model->id]) ?>" class="text-warning"><span
                                        class="fa fa-edit"></span></a>
                            &nbsp;
                            <a href="<?= Url::to(['delete', 'id' => $model->id]) ?>" class="text-danger"
                               onclick="return confirm('آیا حذف شود؟')"><span class="fa fa-times"></span></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
    <div class="col-sm-12">
        <?= LinkPager::widget(['pagination' => $pages]) ?>
    </div>
</div>
