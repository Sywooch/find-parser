<?php

use yii\db\Migration;

class m151125_181500_create_item_table extends Migration
{
    public function safeUp()
    {
        $this->dropTable('parse');
        $this->createTable('items', [
            'id' => $this->primaryKey()->notNull(),
            'product' => $this->string()->notNull(),
            'price' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'store' => $this->string()->notNull(),
            'options' => $this->string()->notNull(),
            'subcategory_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('items');
        $this->createTable('parse', [
            'id' => $this->primaryKey()->notNull(),
            'product' => $this->string()->notNull(),
            'price' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'store' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);
    }
}
