<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'مدیریت',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed',
        ],
    ]);
    $menuItems[] = '<li>' . Html::beginForm(['/site/logout'], 'post', ['class' => 'btn']) . Html::submitButton('خروج (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']) . Html::endForm() . '</li>';
    $menuItems[] = ['label' => 'سایت', 'url' => '/', 'linkOptions' => ['target' => '_blank']];
    $menuItems[] = ['label' => 'خانه', 'url' => ['/site/index']];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="row">
        <ul class="col-sm-2 menu ul-menu">
            <li class="link">
                <a href="<?= Url::to(['site/index']) ?>"><span class="fa fa-dashboard"></span> داشبورت</a>
            </li>
            <li class="dropdownm" id="23424">
            <li class="dropdownm" id="88531315">
                <a href="#">
                    <span class="fa fa-files-o"></span> مطالب
                    <span class="pull-left fa fa-caret-right">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="<?= Url::to(['articles/create']); ?>">ایجاد مطلب</a></li>
                    <li><a href="<?= Url::to(['articles/index']); ?>">مطالب</a></li>
                    <li><a href="<?= Url::to(['categoryarticles/index']); ?>"><span class="fa fa-sitemap"></span> دسته بندی مطالب</a></li>
                </ul>
            </li>
            <li class="dropdownm" id="12165">
                <a href="#">
                    <span class="fa fa-diamond"></span> نمونه کار
                    <span class="pull-left fa fa-caret-right">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="<?= Url::to(['project/create']); ?>">ایجاد نمونه کار</a></li>
                    <li><a href="<?= Url::to(['project/index']); ?>">نمونه کارها</a></li>
                    <li><a href="<?= Url::to(['categoryproject/index']); ?>"><span class="fa fa-sitemap"></span> دسته بندی نمونه کارها</a></li>
                    <li><a href="<?= Url::to(['technology/index']); ?>"><span class="fa fa-gears"></span> لیست تکنولوژی ها</a></li>
                </ul>
            </li>
            <li class="dropdownm" id="8992315">
                <a href="#">
                    <span class="fa fa-comments"></span> نظرات
                    <span class="pull-left fa fa-caret-right">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="<?= Url::to(['comment/index']); ?>">لیست نظرات</a></li>
                </ul>
            </li>
            <li class="link"><a href="<?= Url::to(['setting/index']) ?>"><span class="fa fa-gears"></span> تنظیمات</a></li>
            <li class="link"><a href="#"><span class="fa fa-envelope"></span> ایمیل های پشتیبانی</a></li>
            <li class="link"><a href="#"><span class="fa fa-hdd-o"></span> سیستم</a></li>
            <li class="link"><a href="#"><span class="fa fa-bars"></span> Log</a></li>
        </ul>
        <div class="col-sm-10 content">
            <div style="margin-top: 25px;"></div>
            <?= $content; ?>
        </div>
    </div>
</div>


<?php $this->endBody() ?>
<script>
    $('.sub-menu').hide();
    $('.dropdownm').click(function () {
        var id = $(this).attr('id');
        if ($('#' + id + ' > .sub-menu').css('display') == 'none') {
            $('#' + id + ' > a > .pull-left').addClass('fa-caret-down');
            $('#' + id + ' > a > .pull-left').removeClass('fa-caret-right');
            $('#' + id).css('background-color', '#010029');
        } else {
            $('#' + id + ' > a >.pull-left').addClass('fa-caret-right');
            $('#' + id + ' > a >.pull-left').removeClass('fa-caret-down');
            $('#' + id).css('background-color', '');
        }
        $('#' + id + ' > .sub-menu').slideToggle();
    });
</script>
</body>
</html>
<?php $this->endPage() ?>
