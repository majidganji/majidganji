<?php 

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'تنظیمات';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row well-c">
	<div class="col-sm-6">
		<p><STRONG>نام کاربری:</STRONG> <?= Html::encode(Yii::$app->user->identity->username) ?></p>
		<p><strong>ایمیل:</strong> <?= Html::encode(Yii::$app->user->identity->email) ?></p>
	</div>
	<div class="col-sm-6">
		<a href="<?= Url::to(['changeprofile']) ?>" class="btn btn-success">تنظیمات حساب کاربری</a>	
		<p></p>
		<a href="<?= Url::to(['changepassword']) ?>" class="btn btn-primary">تغییر رمز عبور</a>
	</div>
</div>

<div class="row well-c">
    <a href="<?= Url::to(['clear_cache']) ?>">پاک کردن cache سیستم</a>
</div>