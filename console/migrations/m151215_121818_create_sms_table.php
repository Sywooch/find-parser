<?php

use yii\db\Migration;

class m151215_121818_create_sms_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('sms', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'text' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);
        $this->addForeignKey('sms_to_user', 'sms', 'user_id', 'users', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('sms_to_user', 'sms');
        $this->dropTable('sms');
    }
}
