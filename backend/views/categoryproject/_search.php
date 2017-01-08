<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="alert alert-success">
	<h4>جستجو</h4>
	<hr>
	<?=Html::beginForm(['search'], 'get');?>
		<div class="form-group">
			<label for="id">ردیف:</label>
			<?=Html::input('text', 'id', null, ['class' => 'form-control', 'id' => 'id']);?>
		</div>
		<div class="form-group">
			<label for="name">نام:</label>
			<?=Html::input('text', 'name', null, ['class' => 'form-control', 'id' => 'name']);?>
		</div>
		<div class="form-group">
			<label for="slug">مسیر:</label>
			<?=Html::input('text', 'slug', null, ['class' => 'form-control', 'id' => 'slug']);?>
		</div>
		<div class="form-group">
			<?=Html::submitButton('جستجو', ['class' => 'btn btn-default']);?>
			<a href="<?=Url::to(['index']);?>" class="btn btn-default">لیست کامل</a>
		</div>
	<?=Html::endForm();?>
</div>