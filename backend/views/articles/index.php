<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'مطالب';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="well-c">
    <h4><?= Html::encode($this->title) ?></h4>

    <p style="margin-top: 15px;">
        <a href="<?= Url::to(['create']) ?>" class="btn btn-primary">درج مطلب جدید</a>
        <a href="#" id="a-search" class="btn btn-info">جستجو</a>
    </p>

    <div class="" id="d-search" style="display: none;">
        <?= $this->render('_search') ?>
    </div>
</div>

<div class="row well-c">
    <div class="col-sm-12">
        <a href="<?= Url::to(['index', 'sort' => 1]) ?>" class="btn btn-default">ID صعودی</a>
        <a href="<?= Url::to(['index', 'sort' => 2]) ?>" class="btn btn-default">ID نزولی</a>
        <a href="<?= Url::to(['index', 'sort' => 3]) ?>" class="btn btn-default">عنوان صعودی</a>
        <a href="<?= Url::to(['index', 'sort' => 4]) ?>" class="btn btn-default">عنوان نزولی</a>
    </div>
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