<?php

use yii\db\Migration;

class m161112_070156_my_skill extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%skills}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%skills}}');
    }
}
