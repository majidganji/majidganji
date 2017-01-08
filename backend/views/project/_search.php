<?php

use backend\models\Projects;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="alert alert-success">
			<h3>جستجو</h3>
			<hr>
	<div class="row">
		<?=Html::beginForm(['search'], 'get');?>
		<div class="col-sm-4">
			<div class="form-group">
				<label for="id">ردیف:</label>
				<?=Html::input('text', 'id', null, ['class' => 'form-control', 'name' => 'id']);?>
			</div>
			<div class="form-group">
				<label for="customer_name">نام مشتری:</label>
				<?=Html::input('text', 'customer_name', null, ['class' => 'form-control', 'name' => 'customer_name']);?>
			</div>
			<div class="form-group">
				<label for="customer_email">پست الکترونیکی مشتری:</label>
				<?=Html::input('text', 'customer_email', null, ['class' => 'form-control', 'name' => 'customer_email']);?>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label for="phone_mobile">تلفن همراه:</label>
				<?=Html::input('text', 'phone_mobile', null, ['class' => 'form-control', 'name' => 'phone_mobile']);?>
			</div>
			<div class="form-group">
				<label for="phone_static">تلفن ثابت:</label>
				<?=Html::input('text', 'phone_static', null, ['class' => 'form-control', 'name' => 'phone_static']);?>
			</div>
			<div class="form-group">
				<label for="total_amount">مبلغ کل پروژه:</label>
				<?=Html::input('text', 'total_amount', null, ['class' => 'form-control', 'name' => 'total_amount']);?>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label for="prepayment">پیش پرداخت:</label>
				<?=Html::input('text', 'prepayment', null, ['class' => 'form-control', 'name' => 'prepayment']);?>
			</div>
			<div class="form-group">
				<label for="name_project">نام پروژه:</label>
				<?=Html::input('text', 'name_project', null, ['class' => 'form-control', 'name' => 'name_project']);?>
			</div>
			<div class="form-group">
				<label for="status">وضیعت:</label>
				<?=Html::dropDownList('status', null,
    [
        null => '',
        Projects::STATUS_ACTIVE => 'فعال',
        Projects::STATUS_DELETED => 'حذف شده',
    ], ['class' => 'form-control', 'name' => 'status']);?>
			</div>
		</div>


			<div class="col-sm-12">
				<div class="form-group">
					<?=Html::submitButton('جستجو', ['class' => 'btn btn-default']);?>
					<a href="<?=Url::to(['index']);?>" class="btn btn-default">لیست کامل</a>
				</div>
			</div>
	<?=Html::endForm();?>
	</div>
		</div>
