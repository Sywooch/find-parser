<?php

use yii\db\Migration;

class m151221_155442_create_transaction_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('transaction', [
            'id' => $this->primaryKey()->notNull(),
            'id_user' => $this->integer()->notNull(),
            'success' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);
        $this->addForeignKey('transaction_to_user', 'transaction', 'id_user', 'users', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('transaction_to_user', 'transaction');
        $this->dropTable('transaction');
    }
}
