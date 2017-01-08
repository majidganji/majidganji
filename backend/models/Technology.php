<?php

namespace backend\models;

use Yii;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "{{%technology}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property TechnologyProjects[] $technologyProjects
 * @property Projects[] $projects
 */
class Technology extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%technology}}';
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTechnologyProjects()
    {
        return $this->hasMany(TechnologyProjects::className(), ['technology' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Projects::className(), ['id' => 'project'])->viaTable('{{%technology_projects}}', ['technology' => 'id']);
    }

    public static function findById($id)
    {
        if ($model = static::findOne($id)) {
            return $model;
        }
        throw new NotFoundHttpException('تکنولوژی مورد نظر پیدا نشد.');
    }
}
