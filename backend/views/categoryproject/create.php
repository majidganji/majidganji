<?php

$this->title = 'درج دسته بندی پروژه ها';

$this->params['breadcrumbs'][] = ['label' => 'دسته بندی پروژه ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-sm-12 well-c">
		<h3><?=$this->title;?></h3>
	</div>
	<div class="col-sm-4 alert alert-info">
		<?=$this->render('_form', ['model' => $model]);?>
	</div>
</div>
