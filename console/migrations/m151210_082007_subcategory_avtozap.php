<?php

use yii\db\Migration;

class m151210_082007_subcategory_avtozap extends Migration
{
    public function up()
    {
        $this->insert('subcategory', ['title' => 'Автозапчасти', 'category_id' => 2]);
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
