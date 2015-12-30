<?php

use yii\db\Migration;

class m151219_073554_add_sell_house_subcategory extends Migration
{
    public function up()
    {
        $this->insert('subcategory', ['title' => 'Продажа домов', 'category_id' => 3]);
        $this->insert('subcategory', ['title' => 'Коммерческая недвижимость', 'category_id' => 3]);
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
