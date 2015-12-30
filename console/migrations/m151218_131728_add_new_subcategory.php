<?php

use yii\db\Migration;

class m151218_131728_add_new_subcategory extends Migration
{
    public function up()
    {
        $this->insert('subcategory', ['title' => 'Фототехника', 'category_id' => 1]);
        $this->insert('subcategory', ['title' => 'Климатическая техника', 'category_id' => 1]);
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
