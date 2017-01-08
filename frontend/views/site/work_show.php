<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->name;
?>
<div class="row well-c">
	<div class="">

			<div class="col-sm-8">
			<h3><?=Html::encode($this->title);?></h3>
			<hr>
				<?=$model->body;?>
			</div>
			<div class="col-sm-4">
				<div class="row">
					<a href="<?=Url::base();?>/photos/<?=$model->image;?>" data-lity>
					    <img class="img-fluid img-responsive" src="<?=Url::base();?>/photos/temp-<?=$model->image;?>" alt="<?=Html::encode($model->name);?>">
					</a>
				</div>
				<div class="row margin-top-bottom">
					<div>
						<strong>دسته بندی ها:</strong>
						<br>
						<ul>
							<?php foreach ($model->categories as $item): ?>
								<li><?=Html::encode($item->name);?></li>
							<?php endforeach;?>
						</ul>
					</div>
					<div>
						<strong>تکنولوژی ها:</strong>
						<br>
						<ul>
							<?php foreach ($model->technologies as $item): ?>
								<li><?=Html::encode($item->name);?></li>
							<?php endforeach;?>
						</ul>
					</div>
					<strong>قیمت:</strong> <?=$model->total_amount;?> تومان
				</div>
			</div>
		</div>
	</div>
<?php

$this->registerCssFile(Url::base() . '/lity/lity.min.css');
$this->registerJsFile(Url::base() . '/lity/lity.min.js', ['depends' => yii\web\JqueryAsset::className()]);
?>
