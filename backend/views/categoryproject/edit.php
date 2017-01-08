<?php

use yii\helpers\Html;

$this->title = 'ویرایش ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => 'دسته بندی پروژه ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

 <div class="row">
 	<div class="col-sm-12 well-c">
 		<h3><?=Html::encode($this->title);?></h3>
 	</div>
 	<div class="col-sm-4 alert alert-success">
 		<?=$this->render('_form', ['model' => $model]);?>
 	</div>
 </div>