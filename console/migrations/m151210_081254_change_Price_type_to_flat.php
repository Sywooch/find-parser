<?php

use yii\db\Migration;

class m151210_081254_change_Price_type_to_flat extends Migration
{
    public function up()
    {
        $this->alterColumn('items','price','float');
    }

    public function down()
    {
        $this->alterColumn('items','price','integer');

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
