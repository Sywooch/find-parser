<?php

use yii\db\Migration;

class m151218_122210_add_tv_subcategory extends Migration
{
    public function up()
    {
        $this->insert('subcategory', ['title' => 'Телевизоры', 'category_id' => 1]);
    }

    public function down()
    {

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
