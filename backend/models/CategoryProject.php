<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%category_project}}".
 *
 * @property integer $category
 * @property integer $project
 *
 * @property CategoriesProject $category0
 * @property Projects $project0
 */
class CategoryProject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category_project}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'project'], 'required'],
            [['category', 'project'], 'integer'],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => CategoriesProject::className(), 'targetAttribute' => ['category' => 'id']],
            [['project'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category' => 'Category',
            'project' => 'Project',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(CategoriesProject::className(), ['id' => 'category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject0()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project']);
    }
}
