<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%skills}}".
 *
 * @property integer $id
 * @property string $name
 */
class Skills extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%skills}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ردیف',
            'name' => 'نام',
        ];
    }
}
