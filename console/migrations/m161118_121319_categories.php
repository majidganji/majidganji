<?php

use yii\db\Migration;

class m161118_121319_categories extends Migration {

    public function safeUp() {
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment('نام'),
            'slug' => $this->string(255)->notNull()->comment('مسیر'),
        ]);

    }

    public function safeDown() {
        $this->dropTable('{{%categories}}');
    }
}
