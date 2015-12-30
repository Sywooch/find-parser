<?php

use yii\db\Migration;

class m151217_094000_create_news_table extends Migration
{
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'image' => $this->string(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('news');
    }
}
