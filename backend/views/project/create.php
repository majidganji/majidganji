<?php

use yii\helpers\Html;

$this->title = 'ایجاد پروژه جدید';
$this->params['breadcrumbs'][] = ['label' => 'پروژه ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-sm-12 well-c">
		<h3><?=Html::encode($this->title);?></h3>
	</div>
	<?=$this->render('_form', ['model' => $model]);?>
</div>

