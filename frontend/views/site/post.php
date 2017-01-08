<?php

use frontend\models\Comment;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = $model->title;
?>

<div class="panel">
    <div class="view hm-zoom">
        <img src="<?= Yii::$app->request->baseUrl ?>/photos/<?= $model->image ?>" class="img-fluid" alt="">
    </div>
    <div class="panel-heading">
        <h4><?= Html::encode($model->title) ?></h4>
    </div>
    <div class="panel-body">
        <?= $model->body ?>

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
        </div>
    </div>
</div>

<div class="row">
    <div id="comments" class="well-c text-center"><h5>نظرات
            (<?= Comment::find()->where(['post_id' => $model->id, 'status' => 10])->count() ?>)</h5></div>
</div>
    <div class=" row">
        <?php foreach (Comment::find()->where([
            'post_id' => $model->id,
            'status' => 10,
            'parent_id' => NULL
        ])->all() as $comment): ?>
            <div class="row  well-c">
                <div class="col-sm-2">
                    <img src="<?= Yii::$app->request->baseUrl ?>/images/2.png" class="img-responsive">
                </div>
                <div class="col-sm-10">
                    <p style="font-size: 12px;">
                        <span class="fa fa-clock-o fa-lg"></span>&nbsp;<?= Yii::$app->jdf->jdate('l j F y', $comment->ts) ?>
                        &nbsp;| &nbsp;
                        <?= Html::encode($comment->name) ?> می گوید:
                    </p>
                    <?= Html::encode($comment->body) ?>
                    <?php foreach (Comment::find()->where(['status' => 10, 'parent_id' => $comment->id])->all() as $subc): ?>
                    <div class="row alert-c info-color">
                        <div class="col-sm-2">
                            <img src="<?= Yii::$app->request->baseUrl ?>/images/2.png" class="img-responsive">
                        </div>
                        <div class="col-sm-10">
                            <p style="font-size: 12px;">
                                <span class="fa fa-clock-o fa-lg"></span>&nbsp;<?= Yii::$app->jdf->jdate('l j F y', $subc->ts) ?>
                                &nbsp;| &nbsp;
                                <?= Html::encode($subc->name) ?> می گوید:
                            </p>
                            <?= Html::encode($subc->body) ?>
                        </div>
                    </div>

            <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php
Pjax::begin(['enablePushState' => FALSE,]);
$form = ActiveForm::begin(['action' => ['insertcomment'], 'method' => 'post', 'options' => ['data-pjax' => TRUE]]);
$comment = new Comment();
?>
<div class="row well-c">
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($comment, 'name') ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($comment, 'email') ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($comment, 'website') ?>
        </div>
        <input type="hidden" name="post" value="<?= Yii::$app->security->hashData($model->id, 'hsdvjadhsda') ?>">
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($comment, 'verifyCode')->widget(Captcha::className()) ?>
            <div class="form-group">
                <?= Html::submitButton('درج نظر', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="col-sm-8">
            <?= $form->field($comment, 'body')->textarea(['rows' => 7, 'style' => 'resize:none;']) ?>
        </div>

    </div>
</div>
<?php ActiveForm::end();
Pjax::end(); ?>
