<?php

use yii\helpers\Url;

$this->title = 'دسته بندی پروژه ها';

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

	<div class="col-sm-12 well-c" style="margin-top: 20px;">
		<p>
			<a class="btn btn-primary" href="<?=Url::to(['create']);?>">درج</a>&nbsp;
			<a id="search-btn" class="btn btn-success">جستجو</a>
		</p>
		<div class="col-sm-4" style="display: none;" id="search-dev">
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

$script = <<<js
	$('#search-btn').click(function(){
		$('#search-dev').slideToggle();
	});
js;
$this->registerJs($script);
?>