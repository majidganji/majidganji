<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>


<table class="table table-striped table-responsive table-hover table-condensed table-bordered">
	<tr">
		<th>ردیف</th>
		<th>نام پروژه</th>
		<th>وضیعت</th>
		<th>قیمت کل</th>
		<th>&nbsp;</th>
	</tr>

    <?php if (!empty($models)): ?>
		<?php foreach ($models as $model): ?>
			<tr class="<?=($model->status == 0) ? '' : '';?>">
				<td><a href="<?=Url::to(['view', 'id' => $model->id]);?>"><?=Html::encode($model->id);?></a></td>
				<td><?=Html::encode($model->name);?></td>
				<td><?=Html::encode(($model->status) ? 'فعال':'غیر فعال' );?></td>
				<td><?=Html::encode($model->total_amount);?></td>
				<td>
					<div class="dropdown">
					  <button class="dropdown-toggle" type="button" data-toggle="dropdown"><span class="fa fa-bars"></span>	</button>
					  <ul class="dropdown-menu dropdown-menu-left">
					    <li><a href="<?=Url::to(['view', 'id' => $model->id]);?>">نمایش</a></li>
					    <li><a href="<?=Url::to(['edit', 'id' => $model->id]);?>">ویرایش</a></li>
					    <li><a onclick="return confirm('آیا حذف شود؟');" href="<?=Url::to(['fulldelete', 'id' => $model->id]);?>">حذف</a></li>
					  </ul>
					</div>
				</td>
			</tr>
		<?php endforeach;?>
	<?php else: ?>
		<tr class="danger">
			<td colspan="9">پروژه ای وجود ندارد.</td>
		</tr>
	<?php endif;?>
</table>
