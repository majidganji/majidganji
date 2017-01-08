
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<table class="table table-responsive table-hover table-striped table-condensed table-bordered">
			<tr class="success">
				<th class="col-sm-1">ردیف</th>
				<th>نام</th>
				<th class="col-sm-2">&nbsp;</th>
			</tr>
			<?php if (!empty($models)): ?>
				<?php foreach ($models as $model): ?>
					<tr>
						<td><?=Html::encode($model->id);?></td>
						<td><?=Html::encode($model->name);?></td>
						<td>
							<a href="<?=Url::to(['view', 'id' => $model->id]);?>" class="text-info">نمایش</a>&nbsp;
							<a href="<?=Url::to(['edit', 'id' => $model->id]);?>" class="text-warning">ویرایش</a>&nbsp;
							<a href="<?=Url::to(['delete', 'id' => $model->id]);?>" class="text-danger" onclick="return confirm('آیا حذف شود');">حذف</a>
						</td>
					</tr>
				<?php endforeach;?>
			<?php else: ?>
				<tr>
					<td colspan="3">لیست خالی می باشد.</td>
				</tr>
			<?php endif;?>
		</table>

		<?=LinkPager::widget([
    'pagination' => $pages,
]);?>