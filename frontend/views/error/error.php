<?php

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1 style="font-size: 100px;"><?= Html::encode($code) ?></h1>

    <h2><?= nl2br(Html::encode($message)) ?></h2>
    <br><br>
    <h1>¯\_(ツ)_/¯</h1>
    <br><br><br>
    <a href="<?= \yii\helpers\Url::to(['site/index']) ?>" class="btn unique-color-dark">صفحه‌ اصلی</a>
</div>
