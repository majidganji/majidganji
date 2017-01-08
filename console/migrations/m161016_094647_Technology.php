<?php

use yii\db\Migration;

class m161016_094647_Technology extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%technology}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique(),
        ]);

    }

    public function safeDown()
    {
        $this->dropTable('{{%technology}}');
    }
}
