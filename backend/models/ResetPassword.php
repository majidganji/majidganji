<?php

namespace backend\models;

use Yii;
use backend\models\Admin;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class ResetPassword extends Model
{

    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['password', 'password_repeat'], 'required'],
            [['password', 'password_repeat'], 'string', 'min' => 6],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password', 'message' => 'رمز عبور باید عینا تکرار شود.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'رمز عبور',
            'password_repeat' => 'تکرار رمز عبور',
        ];
    }

    public function ok(){
        if (!($model = Admin::findOne(Yii::$app->user->getId()))) {
            throw new NotFoundHttpException('دسترسی ندارید.');
        }

        $model->password_hash = $this->getHashPassword();
        if ($model->save()) {
            return true;
        }else{
            return false;
        }
    }

    private function getHashPassword(){
        return Yii::$app->getSecurity()->generatePasswordHash($this->password);
    }
}
