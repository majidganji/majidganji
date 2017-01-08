<?php

use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'لیست تکنولوژی ها';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-sm-12 well-c" style="margin-top: 20px;">
		<p>
			<a href="<?=Url::to(['create']);?>" class="btn btn-primary">درج</a>
			<a href="#" class="btn btn-success " id="search">جستجو</a>
		</p>
		<div class="row">
			<?=$this->render('_search');?>
		</div>
		<div class="row">
			<div class="col-sm-12 well">
				<a class="btn btn-default" href="<?=Url::to(['index', 'sort' => 1]);?>"><span class="fa fa-sort-numeric-asc"></span>&nbsp;ترتیب شماره صعودی</a>&nbsp;
				<a class="btn btn-default" href="<?=Url::to(['index', 'sort' => 2]);?>"><span class="fa fa-sort-numeric-desc"></span>&nbsp;ترتیب شماره نزولی</a>&nbsp;
				<a class="btn btn-default" href="<?=Url::to(['index', 'sort' => 3]);?>"><span class="fa fa-sort-alpha-asc"></span>&nbsp;ترتیب الفبا صعودی</a>&nbsp;
				<a class="btn btn-default" href="<?=Url::to(['index', 'sort' => 4]);?>"><span class="fa fa-sort-alpha-desc"></span>&nbsp;ترتیب الفبا نزولی</a>&nbsp;
			</div>
		</div>
		<?=$this->render('_list', ['models' => $models, 'pages' => $pages]);?>
	</div>
</div>


<?php
$script = <<<JS
	$('#search').click(function(){
		$('#form-search').slideToggle();
	});
JS;

$this->registerJs($script);
?>