<?php

use yii\db\Migration;

class m151120_064923_create_parse_table extends Migration
{
    public function safeUp()
    {
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

    public function safeDown()
    {
        $this->dropTable('parse');
    }
}
