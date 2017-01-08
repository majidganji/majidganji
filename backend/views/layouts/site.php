<?php

use common\widgets\Alert;
use yii\widgets\Breadcrumbs;
use yii\widgets\Pjax;

?>
<?php
$this->beginContent('@backend/views/layouts/main.php');
Pjax::begin();
?>
    <div class="row">
        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]); ?>
        <?= Alert::widget(); ?>
    </div>
<?= $content; ?>
<?php
Pjax::end();
$this->endContent();
