<?php

use yii\helpers\Html;

$this->title = 'درج تکنولوژی';
$this->params['breadcrumbs'][] = ['label' => 'لیست تکنولوژی ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="well-c">
		<h4><?=Html::encode($this->title);?></h4>
	</div>
	<div class="col-sm-4 alert alert-info">
		<?=$this->render('_form', ['model' => $model]);?>
	</div>
</div>
