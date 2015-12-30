<?php

use yii\db\Migration;

class m151218_210537_add_plans_payment_plans extends Migration
{
    private $_table = 'payment_plans';
    public function safeUp()
    {
        $this->insert($this->_table, [
            'name' => 'BasicElectronic',
            'max_allow_sms' => 5,
            'price' => 200
        ]);
        $this->insert($this->_table, [
            'name' => 'AdvancedElectronic',
            'max_allow_sms' => 10,
            'price' => 250
        ]);
        $this->insert($this->_table, [
            'name' => 'ProElectronic',
            'max_allow_sms' => 15,
            'price' => 300
        ]);

        $this->insert($this->_table, [
            'name' => 'BasicTransport',
            'max_allow_sms' => 5,
            'price' => 200
        ]);
        $this->insert($this->_table, [
            'name' => 'AdvancedTransport',
            'max_allow_sms' => 10,
            'price' => 250
        ]);
        $this->insert($this->_table, [
            'name' => 'ProTransport',
            'max_allow_sms' => 15,
            'price' => 300
        ]);
    }

    public function safeDown()
    {
    }
}
