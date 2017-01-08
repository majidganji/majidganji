<?php

use yii\helpers\Url;

$this->title = 'پروژه ها';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-sm-12 well-c">
		<p>
			<a href="<?=Url::to(['create']);?>" class="btn btn-primary">ایجاد پروژه</a>
			<a href="#" id="search-btn" class="btn btn-success">جستجو</a>
		</p>

		<div style="display: none;" id="search-dev">
			<?=$this->render('_search');?>
		</div>
	</div>
	<div class="col-sm-12 well-c">
		<div class="well">
		ترتیب:
			<a href="<?=Url::to(['index', 'sort' => 1]);?>" class="btn btn-default">ردیف صعودی</a>
			<a href="<?=Url::to(['index', 'sort' => 2]);?>" class="btn btn-default">ردیف نزولی</a>
            <a href="<?=Url::to(['index', 'sort' => 3]);?>" class="btn btn-default">پروژه های حذف شده بالا</a>
            <a href="<?=Url::to(['index', 'sort' => 4]);?>" class="btn btn-default">پروژه های فعال بالا</a>
		</div>
			<?=$this->render('_list', ['models' => $models, 'pages' => $pages]);?>
		</div>
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