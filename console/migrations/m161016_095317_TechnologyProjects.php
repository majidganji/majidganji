<?php

use yii\db\Migration;

class m161016_095317_TechnologyProjects extends Migration
{
    public function safeUp()
    {

        $this->createTable('{{%technology_projects}}',[
            'technology' => $this->integer()->notNull(),
            'project' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-technology_projects', '{{%technology_projects}}', ['technology', 'project']);

        $this->createIndex('idx-technology_projects-technology', '{{%technology_projects}}', 'technology');

        $this->addForeignKey('fk-technology_projects-technology', '{{%technology_projects}}', 'technology', '{{%technology}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-technology_projects-project', '{{%technology_projects}}', 'project');

        $this->addForeignKey('fk-technology_projects-project', '{{%technology_projects}}', 'project', '{{%projects}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-technology_projects-project', '{{%technology_projects}}');
        $this->dropIndex('idx-technology_projects-project', '{{%technology_projects}}');
        $this->dropForeignKey('fk-technology_projects-technology', '{{%technology_projects}}');
        $this->dropIndex('idx-technology_projects-technology', '{{%technology_projects}}');
        $this->dropPrimaryKey('pk-technology_projects', '{{%technology_projects}}');
        $this->dropTable('{{%technology_projects}}');
    }
}
