<?php
    use yii\helpers\Url;
?>
<table class="table table-responsive table-hover table-striped">
    <tr>
        <th>ردیف</th>
        <th>نام</th>
        <th class="col-sm-2">
            <span class="fa fa-gears"></span>
        </th>
    </tr>
    <?php foreach ($models as $model): ?>
        <tr>
            <td>
                <?= encode($model->id) ?>
            </td>
            <td>
                <?= encode($model->name) ?>
            </td>
            <td>
                <a href="<?= Url::to(['skill/edit', 'id' => $model->id]) ?>" class="text-warning">ویرایش</a>&nbsp;
                <a href="<?= Url::to(['skill/delete', 'id' => $model->id]) ?>" class="text-danger" onclick="return confirm('آیا حذف شود؟');">حذف</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>