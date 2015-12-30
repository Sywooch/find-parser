<?php

use yii\db\Migration;

class m151125_182925_create_subcategory_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('subcategory', [
            'id' => $this->primaryKey()->notNull(),
            'title' => $this->string()->notNull(),
            'category_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey('category_to_subcategory', 'subcategory', 'category_id', 'category', 'id');
        $this->addForeignKey('item_to_subcategory', 'items', 'subcategory_id', 'subcategory', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('item_to_subcategory', 'items');
        $this->dropForeignKey('category_to_subcategory', 'subcategory');
        $this->dropTable('subcategory');
    }
}
