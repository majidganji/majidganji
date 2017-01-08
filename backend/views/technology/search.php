<?php

use yii\helpers\Url;

$this->title = 'جستجو';
$this->params['breadcrumbs'][] = ['label' => 'لیست تکنولوژی ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
<div class="well-c">
	<p>
			<a href="<?=Url::to(['create']);?>" class="btn btn-primary btn-lg">درج</a>
			<a href="#" class="btn btn-success btn-lg" id="search">جستجو</a>
		</p>
		<div class="row">
			<?=$this->render('_search');?>
		</div>
	<h3><?=$this->title;?></h3>
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