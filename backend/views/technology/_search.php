<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="col-sm-3 alert alert-success" style="display: none;" id="form-search">
	<?=Html::beginForm(['search'], 'get');?>
			<div class="form-group">
				<label for="tach-id">ردیف:</label>
				<?=Html::input('text', 'id', null, ['class' => 'form-control', 'name' => 'tech-id']);?>
			</div>
			<div class="form-group">
				<label for="tach-name">نام:</label>
				<?=Html::input('text', 'name', null, ['class' => 'form-control', 'name' => 'tech-name']);?>
			</div>
			<div class="form-group">
				<?=Html::submitButton('جستجو', ['class' => 'btn btn-default']);?>
				<a href="<?=Url::to(['index']);?>" class="btn btn-default">لیست کامل</a>
			</div>
	<?=Html::endForm();?>
</div>