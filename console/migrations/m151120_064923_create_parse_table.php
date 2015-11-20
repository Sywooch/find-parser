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
            'magazine' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey('user_to_parse', 'parse', 'user_id', 'users', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('olx');
        $this->dropForeignKey('user_to_parse', 'parse');
    }
}
