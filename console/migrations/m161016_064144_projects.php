<?php

use yii\db\Migration;

class m161016_064144_projects extends Migration {

    public function up() {
        $this->createTable('{{%projects}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'body' => $this->text()->notNull(),
            'image' => $this->string(255)->notNull(),
            'total_amount' => $this->integer()->notNull(),
            'slug' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->defaultValue(8),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    public function down() {
        $this->dropTable('{{%projects}}');
    }
}
