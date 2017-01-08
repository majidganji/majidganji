<?php

use yii\db\Migration;

class m161117_174058_admin extends Migration {

    public function safeUp() {
        $tableOptions = NULL;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%admin}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $admin = new \common\models\Admin();
        $admin->username = 'admin';
        $admin->auth_key = Yii::$app->security->generateRandomString(32);
        $admin->password_hash = Yii::$app->security->generatePasswordHash('123456');
        $admin->password_reset_token = Yii::$app->security->generateRandomString();
        $admin->email = 'majidganji313@gmail.com';
        $admin->status = 10;
        $admin->created_at = time();
        $admin->updated_at = time();
        $admin->save();
    }

    public function safeDown() {
        $this->dropTable('{{%admin}}');
    }
}
