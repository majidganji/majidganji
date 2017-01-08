<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%technology_projects}}".
 *
 * @property integer $technology
 * @property integer $project
 *
 * @property Projects $project0
 * @property Technology $technology0
 */
class TechnologyProjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%technology_projects}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['technology', 'project'], 'required'],
            [['technology', 'project'], 'integer'],
            [['project'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project' => 'id']],
            [['technology'], 'exist', 'skipOnError' => true, 'targetClass' => Technology::className(), 'targetAttribute' => ['technology' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'technology' => 'Technology',
            'project' => 'Project',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject0()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTechnology0()
    {
        return $this->hasOne(Technology::className(), ['id' => 'technology']);
    }
}
