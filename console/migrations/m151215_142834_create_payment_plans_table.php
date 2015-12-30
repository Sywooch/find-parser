<?php

use yii\db\Migration;

class m151215_142834_create_payment_plans_table extends Migration
{
    private $_table = 'payment_plans';
    public function safeUp()
    {
        $this->createTable($this->_table, [
            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string()->notNull(),
            'max_allow_sms' => $this->integer()->notNull(),
            'price' => $this->integer()
        ]);
        $this->insert($this->_table, [
            'name' => 'Free',
            'max_allow_sms' => 0,
            'price' => 0
        ]);
        $this->insert($this->_table, [
            'name' => 'Basic',
            'max_allow_sms' => 5,
            'price' => 50
        ]);
        $this->insert($this->_table, [
            'name' => 'Advanced',
            'max_allow_sms' => 10,
            'price' => 100
        ]);
        $this->insert($this->_table, [
            'name' => 'Pro',
            'max_allow_sms' => 15,
            'price' => 150
        ]);
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}
