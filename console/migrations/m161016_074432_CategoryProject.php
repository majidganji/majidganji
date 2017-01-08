<?php

use yii\db\Migration;

class m161016_074432_CategoryProject extends Migration
{
    public function up()
    {
        $this->createTable('{{%category_project}}',[
            'category' => $this->integer()->notNull(),
            'project' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-category_project-category-project', '{{%category_project}}', ['category', 'project']);
        $this->createIndex('idx-category_project-category', '{{%category_project}}', 'category');
        $this->addForeignKey('fk_category_project-category', '{{%category_project}}', 'category', '{{%categories_project}}', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx-category_project-project', '{{%category_project}}', 'project');
        $this->addForeignKey('fk_category_project-project', '{{%category_project}}', 'project', '{{%projects}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_category_project-project', '{{%category_project}}');
        $this->dropIndex('idx-category_project-project', '{{%category_project}}');
        $this->dropForeignKey('fk_category_project-category', '{{%category_project}}');
        $this->dropIndex('idx-category_project-category', '{{%category_project}}');
        $this->dropPrimaryKey('pk-category_project-category-project', '{{%category_project}}');
        $this->dropTable('{{%category_project}}');
    }
}
