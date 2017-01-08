<?php

use yii\db\Migration;

class m161016_073952_CategoriesProject extends Migration {

    public function up() {

        $this->createTable('{{%categories_project}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique(),
        ]);
    }

    public function down() {
        $this->dropTable('{{%categories_project}}');
    }
}
