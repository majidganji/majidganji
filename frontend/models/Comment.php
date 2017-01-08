<?php

namespace frontend\models;

use backend\models\Articles;
use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $parent_id
 * @property string $name
 * @property string $email
 * @property string $website
 * @property string $body
 * @property integer $ts
 * @property integer $status
 *
 * @property Comment $parent
 * @property Comment[] $comments
 * @property Articles $post
 */
class Comment extends \yii\db\ActiveRecord
{

    public $verifyCode;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'parent_id', 'ts', 'status'], 'integer'],
            [['name', 'email', 'body', 'post_id'], 'required'],
            [['body'], 'string'],
            [['name', 'email', 'website'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Articles::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['verifyCode'], 'required'],
            [['verifyCode'], 'captcha']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'parent_id' => 'Parent ID',
            'name' => 'نام',
            'email' => 'پست الکترونیکی',
            'website' => 'وب سایت',
            'body' => 'متن',
            'ts' => 'زمان درج',
            'status' => 'وضعیت',
            'verifyCode' => 'کد امنیتی',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Comment::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Articles::className(), ['id' => 'post_id']);
    }
}
