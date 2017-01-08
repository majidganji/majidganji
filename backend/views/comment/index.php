<?php

use yii\helpers\Html;

$this->title = 'نظرات';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <div class="row well-c"><h3><?= Html::encode($this->title) ?></h3></div>
    <div class="row well-c">
        <a href="#" id="a-search" class="btn btn-primary">جستجو</a>
        <div style="margin-top: 15px; display:none;" class="well" id="div-search">
        	<?php  echo $this->render('_search'); ?>
        </div>
    </div>

    <div class="row well-c">
        <?= $this->render('_list', ['models' => $models, 'pages' => $pages]) ?>
    </div>
</div>

<?php 
$script = <<<JS
	$('#a-search').click(function(){
		$('#div-search').slideToggle();
	});
JS;

$this->registerJs($script);
?>