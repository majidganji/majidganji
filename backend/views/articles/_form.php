<?php

use backend\models\Categories;
use moonland\tinymce\TinyMCE;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin();
?>


    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'slug') ?>
            <?= $form->field($model, 'image')->fileInput() ?>
            <?php if (!$model->isNewRecord): ?>
                <img src="<?= Yii::$app->request->baseUrl ?>/../photos/<?= $model->image ?>"
                     alt="<?= Html::encode($model->title) ?>" class="img-responsive">
            <?php endif; ?>
            <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Categories::find()->all(), 'id', 'name')); ?>
            <?= $form->field($model, 'status')->dropDownList([10 => 'فعال', 0 => 'غیر فعال']) ?>
            <div class="form-group">
                <?= Html::submitButton(($model->isNewRecord ? 'درج مطلب جدید' : 'بروز رسانی'), [
                    'class' => 'btn btn-' . ($model->isNewRecord ? 'primary' : 'success')
                ]) ?>
            </div>
        </div>
        <div class="col-sm-9">
            <?= $form->field($model, 'title') ?>
            <?= $form->field($model, 'body')->widget(TinyMCE::className(), [
                'options' => ['rows' => 6, 'style' => 'font-size:14px;'],
                "height" =>  400,
                "directionality" => 'rtl',
                'language' => 'fa_IR',
                'clientOptions' => [
                    'plugins' => [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table contextmenu paste code'
                    ],
                    'toolbar' => "undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                ],
            ]) ?>
        </div>
    </div>


<?php ActiveForm::end(); ?>