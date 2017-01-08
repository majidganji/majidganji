<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'نمونه کارها';
?>


<?php if (empty($models)): ?>
    <div class="row">
        <div class="alert warning-color-dark">نمونه کار وجود ندارد :(</div>
    </div>
<?php else: ?>
    <?php foreach ($models as $model): ?>
        <div class="row well-c">
            <div class="col-md-5 ">
                <div class="view overlay hm-white-slight">
                    <img class="img-responsive" src="<?= Yii::$app->request->baseUrl ?>/photos/<?= $model->image ?>">
                    <a>
                        <div class="mask"></div>
                    </a>
                </div>
            </div>
            <div class="col-md-7 ">
                <h4><a href="<?= Url::to(['site/workshow', 'slug' => $model->slug]) ?>"><?= Html::encode($model->name) ?></a></h4>
                <?= Yii::$app->helper->shortText($model->body); ?>
                <p>
                    <a href="<?= Url::to(['site/workshow', 'slug' => $model->slug]) ?>" class="btn btn-primary">ادامه</a>
                    <span class="btn-other pull-left"><span class="fa fa-calendar"></span>&nbsp;تاریخ: <?= Yii::$app->jdf->jdate('j F y', $model->created_at) ?></span>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>