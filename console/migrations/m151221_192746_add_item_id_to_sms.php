<?php

use yii\db\Migration;

class m151221_192746_add_item_id_to_sms extends Migration
{
    public function safeUp()
    {
        $this->addColumn('sms', 'item_id', $this->integer()->notNull());
        $this->addForeignKey('item_to_sms', 'sms', 'item_id', 'items', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('item_to_sms', 'sms');
        $this->dropColumn('sms', 'item_id');
    }
}
