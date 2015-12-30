<?php

use yii\db\Migration;

class m151118_150253_create_users_table extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey()->notNull(),
            'username' => $this->string()->notNull(),
            'fio' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull(),
            'status' => $this->integer()->notNull(),
            'role' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
