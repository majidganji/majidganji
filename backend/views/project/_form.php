<?php

use backend\models\CategoriesProject;
use backend\models\Projects;
use backend\models\Technology;
use moonland\tinymce\TinyMCE;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

?>
<!-- 'enableAjaxValidation' => false, 'enableClientValidation' => false, -->
<div class="col-sm-12 well-c">
		<?php $form = ActiveForm::begin(['id' => 'create-project', 'options' => ['enctype' => 'multipart/form-data']]);?>
    <div class="row">
        <div class="col-sm-9">
            <?=$form->field($model, 'name')->textInput();?>
        </div>
        <div class="col-sm-3">
					<?=$form->field($model, 'total_amount')->textInput(['style' => 'direction:ltr;']);?>
                </div>
			</div>
			<div class="col-sm-12">
				<p class="text-danger">حتما پر کنید.</p>
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
			<div class="row">
				<div class="col-sm-7">
					<?=$form->field($model, 'slug')->textInput(['dir' => 'auto']);?>
				</div>
				<div class="col-sm-5">
				<?php if ($model->isNewRecord): ?>
					<?=$form->field($model, 'category')->dropDownList(ArrayHelper::map(CategoriesProject::find()->select(['id', 'name'])->all(), 'id', 'name'), ['id' => 'category', 'multiple' => 'multiple']);?>
				<?php else: ?>

					<label for="category">دسته بندی ها:</label>
					<select name="Projects[category][]" id="category" multiple="multiple" class="form-control">
						<?php foreach (CategoriesProject::find()->select(['id', 'name'])->all() as $item): ?>
							<option <?=in_array($item->id, $model->categoriesId ?: []) ? 'selected="selected"' : '';?> value="<?=$item->id;?>"><?=$item->name;?></option>
						<?php endforeach;?>
					</select>
					<?php if ($model->hasErrors('category')): ?>
						<div class="text-danger"><?=$model->getFirstError('category');?></div>
					<?php endif;?>
				<?php endif;?>

				</div>
				<div class="row">
					<div class="col-sm-9">
					<?php if ($model->isNewRecord): ?>
						<?=$form->field($model, 'tech')->dropDownList(ArrayHelper::map(Technology::find()->select(['id', 'name'])->all(), 'id', 'name'), ['id' => 'tech', 'multiple' => 'multiple']);?>
					<?php else: ?>

						<label for="tech">تکنولوژی ها:</label>
						<select name="Projects[tech][]" id="tech" multiple="multiple" class="form-control">
							<?php foreach (Technology::find()->all() as $item): ?>
								<option <?=in_array($item->id, $model->techId ?: []) ? 'selected="selected"' : '';?> value="<?=$item->id;?>"><?=$item->name;?></option>
							<?php endforeach;?>
						</select>
						<?php if ($model->hasErrors('tech')): ?>
							<div class="text-danger"><?=$model->getFirstError('tech');?></div>
						<?php endif;?>
					<?php endif;?>
					</div>
					<div class="col-sm-3">
						<?=$form->field($model, 'status')->dropDownList([
    Projects::STATUS_DELETED=> 'حذف شده',
    Projects::STATUS_ACTIVE=> 'فعال',
]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<?=$form->field($model, 'image')->fileInput();?>
				</div>
				<?php if (!$model->isNewRecord): ?>
					<div class="col-sm-4">
						<img src="<?=Yii::getAlias(Url::base() . '/../frontend/web/photos/temp-' . $model->oldImage);?>" alt="" class="img-responsive">
					</div>
				<?php endif;?>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<?=Html::submitButton('درج', ['class' => 'btn btn-primary']);?>
					<?=Html::resetButton('لغو	', ['class' => 'btn btn-default']);?>
				</div>
			</div>
		<?php ActiveForm::end();?>
	</div>
<?php

$this->registerCssFile(Url::base() . '/css/select2.min.css');
$this->registerJsFile(Url::base() . '/js/select2.full.min.js', ['depends' => JqueryAsset::className()]);
$script = <<<js
	$("#category").select2({
		dir: "rtl",
	});
	$("#tech").select2({
		dir: "rtl",
	});
js;
$this->registerJs($script);
?>