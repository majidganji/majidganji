<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;


class CategoriesProject extends ActiveRecord
{
     public $username;
     public $email;

    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ریف',
            'name' => 'نام',
        ];
    }

    public static function findId($id){
        if ($model = static::findOne($id)){
            return $model;
        }
        throw new NotFoundHttpException('پیدا نشد.');
    }
     
}
