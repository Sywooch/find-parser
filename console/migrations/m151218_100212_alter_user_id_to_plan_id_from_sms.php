<?php

use yii\db\Migration;

class m151218_100212_alter_user_id_to_plan_id_from_sms extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('sms_to_user', 'sms');
        $this->dropColumn('sms', 'user_id');
        $this->addColumn('sms', 'search_id', $this->integer()->notNull());
        $this->addForeignKey('sms_to_search', 'sms', 'search_id', 'searched', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('sms_to_search', 'sms');
        $this->dropColumn('sms', 'search_id');
        $this->addColumn('sms', 'user_id', $this->integer()->notNull());
        $this->addForeignKey('sms_to_user', 'sms', 'user_id', 'users', 'id');
    }
}
