<?php

use yii\helpers\Url;

$this->title = 'جستجو';
$this->params['breadcrumbs'][] = ['label' => 'پروژه ها', 'url' => 'index'];
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
</div>

<div class="well-c">
	<?=$this->render('_list', ['models' => $models]);?>
</div>

<?php

$script = <<<js
	$('#search-btn').click(function(){
		$('#search-dev').slideToggle();
	});
js;
$this->registerJs($script);
?>