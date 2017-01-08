<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;

	$this->title= 'تغییر پسورد';
	$this->params['breadcrumbs'][] = ['label' => 'تنظیمات', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
 ?>

 <div class="row">
 	<div class="col-sm-6 well-c">
 		<?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'password')->passwordInput() ?>
		<?= $form->field($model, 'password_repeat')->passwordInput() ?>
		<div class="form-group">
			<?= Html::submitButton('ارسال', ['class' => 'btn btn-success']) ?>
		</div>
 		<?php ActiveForm::end(); ?>
 	</div>
 </div>