<?php

use yii\db\Migration;

class m151217_132839_create_answers_table extends Migration
{
    public function up()
    {
        $this->createTable('answers', [
            'id' => $this->primaryKey()->notNull(),
            'answer' => $this->text()->notNull(),
            'text' => $this->text()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('answers');
    }
}
