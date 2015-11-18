<?php

use yii\db\Migration;

class m151118_161436_create_olx_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('olx', [
            'id' => $this->primaryKey()->notNull(),
            'product' => $this->string()->notNull(),
            'price' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey('user_to_olx', 'olx', 'user_id', 'users', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('olx');
        $this->dropForeignKey('user_to_olx', 'users');
    }
}
