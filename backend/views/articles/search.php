<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'جستجو';
$this->params['breadcrumbs'][] = ['label' => 'مطالب', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="well-c">
    <h4><?= Html::encode($this->title) ?></h4>

    <p style="margin-top: 15px;">
        <a href="#" id="a-search" class="btn btn-info">جستجو</a>
    </p>

    <div class="" id="d-search" style="display: none;">
        <?= $this->render('_search') ?>
    </div>
</div>

<div class="row well-c">

    <div class="col-sm-12" style="margin-top: 15px;">
        <?= $this->render('_list', ['models' => $models, 'pages' => $pages]) ?>
    </div>
</div>
<?php
$script = <<<js
    $('#a-search').click(function() {
        $('#d-search').slideToggle();
    });
js;
$this->registerJs($script);
?>