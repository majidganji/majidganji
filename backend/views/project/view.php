<?php

use backend\models\Projects;
use common\components\JDF;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'پروژه ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<div class="col-sm-12 well-c">
		<h3><?=Html::encode($this->title);?></h3>
		<?php if ($model->status !== Projects::STATUS_DELETED): ?>
			<p>
				<a href="<?=Url::to(['edit', 'id' => $model->id]);?>" class="btn btn-warning">ویرایش</a>
				<a onclick="return confirm('آیا حذف شود؟');" href="<?=Url::to(['delete', 'id' => $model->id]);?>" class="btn btn-danger">حذف</a>
			</p>
		<?php endif;?>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 well-c">

		<table class="table table-hover table-responsive table-striped table-bordered">
			<tr>
				<th>ردیف:</th>
				<td><?=Html::encode($model->id);?></td>
			</tr>
			<tr>
				<th>مبلغ کل پروژه:</th>
				<td><?=Html::encode($model->total_amount);?></td>
			</tr>
			<tr>
				<th>نام پروژه:</th>
				<td><?=Html::encode($model->name);?></td>
			</tr>
			<tr>
				<th>توضیحات:</th>
				<td><?=$model->body;?></td>
			</tr>
			<tr>
				<th>مسیر:</th>
				<td><?=Html::encode($model->slug);?></td>
			</tr>
			<tr>
				<th>تاریخ ثبت پروژه:</th>
				<td><?=Html::encode(JDF::jdate('l j/F/ y - H:i', $model->created_at));?></td>
			</tr>
			<tr>
				<th>وضیعت:</th>
				<td><?=Html::encode(($model->status === Projects::STATUS_ACTIVE ? 'فعال' : 'غیر فعال'));?></td>
			</tr>
			<tr>
				<th>دسته بندی:</th>
				<td>
					<?php foreach ($model->categories as $item): ?>
						<?=Html::encode($item->name);?> |
					<?php endforeach;?>
				</td>
			</tr>
			<tr>
				<th>تکنولوژی:</th>
				<td>
					<?php foreach ($model->technologies as $item): ?>
						<?=Html::encode($item->name);?> |
					<?php endforeach;?>
				</td>
			</tr>
			<tr>
				<th>تصویر:</th>
				<td>
					<img src="<?=Yii::getAlias(Url::base() . '/../frontend/web/photos/temp-' . $model->image);?>" alt="" class="img-responsive">
				</td>
			</tr>
		</table>
	</div>
</div>