<?php

$this->title = 'جستجو';
$this->params['breadcrumbs'][] = ['label' => 'دسته بندی پروژه ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-sm-12 well-c">
	<p>
			<a id="search-btn" class="btn btn-success">جستجو</a>
		</p>
		<div class="col-sm-4" style="display: none;" id="search-dev">
			<?=$this->render('_search');?>
		</div>
		<div class="col-sm-4" style="display: none;" id="search-dev">
			<?=$this->render('_search');?>
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