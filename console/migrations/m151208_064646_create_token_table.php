<?php

use yii\db\Migration;

class m151208_064646_create_token_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('token', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'key' => $this->string()->notNull(),
            'device_id' => $this->string(),
            'device_os' => $this->string(),
            'device_token' => $this->string()->defaultValue(null),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);
        $this->addForeignKey('user_to_token', 'token', 'user_id', 'token', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('user_to_token', 'token');
        $this->dropTable('token');
    }
}
