<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'جستجو';

$this->params['breadcrumbs'][] = ['label' => 'دسته بندی مطالب', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="well-c">
    <?= Html::encode($this->title) ?>
    <p style="margin-top: 15px;">
        <a href="<?= Url::to(['create']) ?>" class="btn btn-success">درج</a>
        <a href="#" id="a-search" class="btn btn-info">جستجو</a>
    </p>

    <div id="div-search" style="display: none;">
        <?= $this->render('_search') ?>
    </div>
</div>

<div class="well-c">
    <?= $this->render('_list', ['models' => $models, 'pages' => $pages]) ?>
</div>
<?php
$script = <<<js
    
    $('#a-search').click(function() {
        $('#div-search').slideToggle(); 
    });
js;

$this->registerJs($script);
?>