<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered table-hover table-striped table-responsive table-condensed">
            <tr>
                <th>ID</th>
                <th>مطلب</th>
                <th>نام</th>
                <th>والد</th>
                <th>وضیعت</th>
                <th class="col-sm-1">&nbsp;</th>
            </tr>
            <?php if (empty($models)): ?>
                <tr>
                    <td colspan="5" class="alert-danger">نظری پیدا نشد.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($models as $model): ?>
                    <tr class="<?= empty($model->parent_id) ? 'success' : 'danger' ?>">
                        <td><a href="<?= Url::to(['view', 'id' => $model->id]) ?>"><?= Html::encode($model->id) ?></a></td>
                        <td><?= Html::encode($model->post->title) ?></td>
                        <td><?= Html::encode($model->name) ?></td>
                        <td>
                            <?php if (!empty($model->parent_id)): ?>
                                <a href="<?= Url::to(['view', 'id' => $model->parent_id]) ?>"><?= Html::encode($model->parent_id) ?></a>
                            <?php else: ?>
                                &nbsp;
                            <?php endif; ?>
                        </td>
                        <td><?= $model->status ? 'فعال' : 'غیر فعال' ?></td>
                        <td>
                            <a href="<?= Url::to(['view', 'id' => $model->id]) ?>" class="text-info"><span class="fa fa-eye"></span></a>
                            &nbsp;
                            <a href="<?= Url::to(['update', 'id' => $model->id]) ?>" class="text-warning"><span class="fa fa-pencil"></span></a>
                            &nbsp;
                            <a href="<?= Url::to(['delete', 'id' => $model->id]) ?>" class="text-danger"><span class="fa fa-times"></span></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>
<?= LinkPager::widget(['pagination' => $pages]) ?>
