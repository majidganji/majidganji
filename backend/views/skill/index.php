<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'مهارت های من';

$this->params['breadcrumbs'][] = $this->title;
?>

<h3 class="well-c"><?= Html::encode($this->title) ?></h3>

<div class="well-c">
    <a href="<?= Url::to(['skill/create']) ?>" class="btn btn-success">درج</a>
    <a onclick="a()" id="btn-search" class="btn btn-info">جستجو</a>
    <div id="div-search" style="display: none;"><?= $this->render('_search'); ?></div>
</div>

<div class="well-c">
    <?= $this->render('_list', ['models'=> $models]) ?>
</div>


<?php
    $script = <<<JS
    $("#btn-search").click(function() {
        $('#div-search').slideToggle();
    });
JS;

    $this->registerJS($script);
?>
