<?php

use yii\db\Migration;

class m161125_091903_comment extends Migration {

    public function safeUp() {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'parent_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'email' => $this->string(255)->notNull()->comment('پست الکترونیکی'),
            'website' => $this->string(255)->null()->comment('وب سایت'),
            'body' => $this->text()->comment('متن'),
            'ts' => $this->integer()->comment('زمان درج'),
            'status' => $this->smallInteger()->defaultValue(0)->notNull()->comment('وضعیت'),
        ]);
        $this->createIndex('idx-comment_to_articles', '{{%comment}}', 'post_id');
        $this->createIndex('idx-articles_to_parent', '{{%comment}}', 'parent_id');
        $this->addForeignKey('fk_comments_to_articles', '{{%comment}}', 'post_id', '{{%articles}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_articles_to_parent', '{{%comment}}', 'parent_id', '{{%comment}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown() {
        $this->dropForeignKey('fk_articles_to_parent', '{{%comment}}');
        $this->dropForeignKey('fk_comments_to_articles', '{{%comment}}');
        $this->dropIndex('idx-articles_to_parent', '{{%comment}}');
        $this->dropIndex('idx-comment_to_articles', '{{%comment}}');
        $this->dropTable('{{%comment}}');
    }
}
