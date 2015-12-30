<?php

use yii\db\Migration;

class m151209_131635_change_price_type_to_int extends Migration
{
    public function up()
    {
        $this->alterColumn('items','price','integer');
    }

    public function down()
    {
        $this->alterColumn('items','price','string');

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
