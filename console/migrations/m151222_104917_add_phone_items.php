<?php

use yii\db\Migration;

class m151222_104917_add_phone_items extends Migration
{
    public function up()
    {
        $this->addColumn('items', 'phone', $this->string());
    }

    public function down()
    {
        $this->dropColumn('items', 'phone');
    }
}
