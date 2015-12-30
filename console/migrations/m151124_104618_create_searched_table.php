<?php

use yii\db\Migration;

class m151124_104618_create_searched_table extends Migration
{
    public function up()
    {
        $this->createTable('searched', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'url' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('searched');
    }
}
