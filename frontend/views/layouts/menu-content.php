<?php use yii\helpers\Html;
use yii\helpers\Url;

$this->beginContent('@frontend/views/layouts/main.php'); ?>
    <div class="row">
        <div class="col-sm-9">
            <?= $content ?>
        </div>
        <div class="col-sm-3">
            <div class="panel indigo darken-4">
                <div class="panel-heading white-text"><span class="fa fa-hashtag"></span>&nbsp;منوی اصلی</div>
                <div class="list-group">
                    <a href="<?= Url::to(['site/index']) ?>" class="list-group-item"><span class="fa fa-home"></span>&nbsp;صفحه‌ای‌
                        اصلی</a>
                    <a href="<?= Url::to(['site/work']) ?>" class="list-group-item"><span class="fa fa-diamond"></span>&nbsp;نمونه کارها </a>
                    <a href="<?= Url::to(['site/contact']) ?>" class="list-group-item"><span class="fa fa-phone"></span>&nbsp;تماس
                        با من</a>
                    <a href="<?= Url::to(['site/abute']) ?>" class="list-group-item"><span class="fa fa-drivers-license-o"></span>&nbsp;درباره من</a>
                </div>
            </div>
            <div class="panel orange darken-2">
                <div class="panel-heading white-text"><span class="fa fa-hashtag"></span>&nbsp;جستجو</div>
                <div class="panel-body">
                    <?= Html::beginForm(['search'], 'GET') ?>
                    <?= Html::textInput('search', null, ['class' => 'form-control white-text', 'placeholder' => 'جستجو ...']) ?>
                    <?= Html::submitButton('جستجو کن !', ['class' => 'btn btn-brown']) ?>
                    <?= Html::endForm(); ?>
                </div>
            </div>
            <div class="panel indigo darken-4">
                <div class="panel-heading white-text"><span class="fa fa-hashtag"></span>&nbsp;دسته بندی ها</div>
                <div class="list-group">
                    <?php foreach (\backend\models\Categories::find()->orderBy('name asc')->all() as $category): ?>
                    <a href="<?= Url::to(['category', 'slug' => $category->slug]) ?>" class="list-group-item"><?= Html::encode($category->name) ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="panel indigo darken-4">
                <div class="panel-heading white-text"><span class="fa fa-hashtag"></span>&nbsp;آرشیو</div>
                <div class="list-group">
                    <?php foreach (Yii::$app->helper->archive() as $month => $array): ?>
                        <a href="<?= Url::to(['site/archive', 'month' => $array['url']]) ?>" class="list-group-item"><?= $month ?> <span class="label label-primary pull-left"><?= $array['count'] ?></span></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
<?php $this->endContent(); ?>