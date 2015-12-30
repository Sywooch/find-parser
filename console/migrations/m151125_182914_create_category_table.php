<?php

use yii\db\Migration;

class m151125_182914_create_category_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey()->notNull(),
            'title' => $this->string()->notNull()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('category');
    }
}
