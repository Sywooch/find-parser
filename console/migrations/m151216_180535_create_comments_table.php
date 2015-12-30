<?php

use yii\db\Migration;

class m151216_180535_create_comments_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey()->notNull(),
            'text' => $this->text()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);
        $this->addForeignKey('comment_to_user', 'comments', 'user_id', 'users', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('comment_to_user', 'comments');
        $this->dropTable('comments');
    }
}
