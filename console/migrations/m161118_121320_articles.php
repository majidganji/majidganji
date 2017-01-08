<?php

use yii\db\Migration;

class m161118_121320_articles extends Migration {

    public function safeUp() {
        $this->createTable('{{%articles}}', [
            'id' => $this->primaryKey(),
            'editor_id' => $this->integer()->notNull()->comment('نویسنده'),
            'category_id' => $this->integer()->notNull()->comment('دسته‌بندی'),
            'title' => $this->string(255)->notNull()->comment('عنوان'),
            'body' => $this->text()->notNull()->comment('متن'),
            'image' => $this->string(255)->notNull()->comment('تصویر'),
            'slug' => $this->string(255)->notNull()->comment('مسیر'),
            'status' => $this->smallInteger()->defaultValue(10)->comment('وضعیت'),
            'created_at' => $this->integer()->notNull()->comment('زمان درج')
        ]);

        $this->createIndex('idx-articles-indexes', '{{%articles}}',['editor_id', 'category_id']);

        $this->addForeignKey('fk-articles-admin-editor', '{{%articles}}', 'editor_id', '{{%admin}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-articles-categories-category_id', '{{%articles}}', 'category_id', '{{%categories}}', 'id', 'cascade', 'cascade');

    }

    public function safeDown() {
        $this->dropForeignKey('fk-articles-categories-category_id', '{{%articles}}');
        $this->dropForeignKey('fk-articles-admin-editor', '{{%articles}}');
        $this->dropIndex('idx-articles-indexes', '{{%articles}}');
        $this->dropTable('{{%articles}}');
    }
}
