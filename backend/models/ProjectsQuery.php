<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Projects]].
 *
 * @see Projects
 */
class ProjectsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Projects[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Projects|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
