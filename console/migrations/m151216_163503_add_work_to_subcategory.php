<?php

use yii\db\Migration;

class m151216_163503_add_work_to_subcategory extends Migration
{
    private $_table = 'subcategory';
    public function up()
    {
        $this->insert($this->_table, ['title' => 'Продажи', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Бары/Рестораны', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Домашний персонал', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Образование', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'IT/Телеком', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Производство', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Студентам', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Транспорт', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Юриспруденция/Бухгалтерия', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Красота/Спорт', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Культура', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Недвижимость', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Секретариат', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Сервис/Быт', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Строительство', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Охрана', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Туризм/Отдых', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Медицина', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Маркетинг', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Частичная занятость', 'category_id' => 6]);
        $this->insert($this->_table, ['title' => 'Другое', 'category_id' => 6]);
    }

    public function down()
    {
    }
}
