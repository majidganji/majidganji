<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;
	$this->title = 'تغییر مشخصات';
	$this->params['breadcrumbs'][] = ['label' => 'تنظیمات', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class=" well-c col-sm-6">
		<?php $form = ActiveForm::begin(); ?>
			<?= $form->field($model, 'username') ?>
			<?= $form->field($model, 'email') ?>
			<div class="form-group">
				<?= Html::submitButton('ارسال', ['class' => 'btn btn-primary']) ?>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>