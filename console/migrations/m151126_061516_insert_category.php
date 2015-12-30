<?php

use yii\db\Migration;

class m151126_061516_insert_category extends Migration
{
    private $_table = 'category';
    public function safeUp()
    {
        $this->insert($this->_table, [
            'title' => 'Электроника'
        ]);
        $this->insert($this->_table, [
            'title' => 'Транспорт'
        ]);
        $this->insert($this->_table, [
            'title' => 'Недвижимость'
        ]);
        $this->insert($this->_table, [
            'title' => 'Отдых, спорт'
        ]);
        $this->insert($this->_table, [
            'title' => 'Бизнес'
        ]);
    }

    public function safeDown()
    {

    }
}
