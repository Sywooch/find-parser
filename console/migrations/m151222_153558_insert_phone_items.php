<?php

use yii\db\Migration;

class m151222_153558_insert_phone_items extends Migration
{
    private $_table = 'items';
    public function safeUp()
    {
        $this->update($this->_table, ['phone' => '(0-800) 300-10'], ['store' => 'Allo']);
        $this->update($this->_table, ['phone' => '0 800 503-808'], ['store' => 'Rozetka']);
        $this->update($this->_table, ['phone' => '0-800-303-505'], ['store' => 'Comfy']);
        $this->update($this->_table, ['phone' => '061-216-0008'], ['store' => 'Microtron']);
        $this->update($this->_table, ['phone' => '(044) 202-15-51'], ['store' => 'FoxMart']);
    }

    public function safeDown()
    {

    }
}
