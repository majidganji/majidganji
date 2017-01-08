<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->name;

$this->params['breadcrumbs'][] = ['label' => 'دسته بندی پروژه ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
 <div class="row">
 	<div class="well-c">
		<h3><?=Html::encode($this->title);?></h3>
		<a href="<?=Url::to(['edit', 'id' => $model->id]);?>" class="btn btn-warning">ویرایش</a>
		<a href="<?=Url::to(['delete', 'id' => $model->id]);?>" class="btn btn-danger" onclick="return confirm('آیا حذف شود');">حذف</a>
	</div>

	<div class="col-sm-12 well-c">
		<table class="table table-striped table-hover table-bordered">
			<tr>
				<th>ردیف</th>
				<td><?=Html::encode($model->id);?></td>
			</tr>
			<tr>
				<th>نام</th>
				<td><?=Html::encode($model->name);?></td>
			</tr>

		</table>
	</div>
 </div>
