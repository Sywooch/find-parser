<?php

use yii\db\Migration;

class m151219_084332_rename_couple_subcat_fields extends Migration
{
    public function up()
    {
        $this->update('subcategory', ['title' => 'Коммерческая недвижимость', 'category_id' => 3], ['id' => 25]);
        $this->delete('subcategory', ['id' => 72]);
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
