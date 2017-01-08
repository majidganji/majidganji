<?php

/* @var $this yii\web\View */

use frontend\models\Comment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = Yii::$app->name;
?>

<?php foreach ($models as $model): ?>
<div class="panel">
    <div class="view hm-zoom">
        <img src="<?= Yii::$app->request->baseUrl ?>/photos/<?= $model->image ?>" class="img-fluid" alt="">
    </div>
    <div class="panel-heading">
        <a href="<?= Url::to(['site/post', 'slug' => $model->slug]) ?>"> <h4><?= Html::encode($model->title) ?></h4></a>
    </div>
    <div class="panel-body">
        <?= Yii::$app->helper->shortText($model->body) ?>
        <p><a href="<?= Url::to(['site/post', 'slug' => $model->slug]) ?>" class="btn btn- btn-outline-primary waves-effect">ادامه مطلب</a></p>
    </div>
    <div class="panel-footer text-muted">
        <div class="row">
            <div class="col-sm-3">
                <span class="fa fa-edit"></span>&nbsp; نویسنده: <?= Html::encode($model->editor->username) ?>
            </div>
            <div class="col-sm-6">
                <div class="text-center">
                    <span class="fa fa-calendar"></span>&nbsp;تاریخ: <?= Yii::$app->jdf->jdate('l j F y', $model->created_at) ?>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="pull-left">
                    <a href="<?= Url::to(['site/post', 'slug' => $model->slug]) ?>#comments"><span class="fa fa-comments"></span> نظرات (<?= Comment::find()->where(['status' => 10, 'post_id' => $model->id])->count() ?>)</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    endforeach;
    echo LinkPager::widget(['pagination' => $pages]);
?>
