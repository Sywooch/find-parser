<?php

use yii\db\Migration;

class m151126_062032_insert_subcategory extends Migration
{
    private $_table = 'subcategory';
    public function safeUp()
    {
        $this->insert($this->_table, ['title' => 'Телефоны', 'category_id' => 1]);
        $this->insert($this->_table, ['title' => 'Компьютеры', 'category_id' => 1]);
        $this->insert($this->_table, ['title' => 'Аудио-видеотехника', 'category_id' => 1]);
        $this->insert($this->_table, ['title' => 'Бытовая техника', 'category_id' => 1]);
        $this->insert($this->_table, ['title' => 'Игры и игровые приставки', 'category_id' => 1]);
        $this->insert($this->_table, ['title' => 'Индивидуальный уход', 'category_id' => 1]);
        $this->insert($this->_table, ['title' => 'Аксессуары и комплектующие', 'category_id' => 1]);
        $this->insert($this->_table, ['title' => 'Прочая техника', 'category_id' => 1]);

        $this->insert($this->_table, ['title' => 'Легковые', 'category_id' => 2]);
        $this->insert($this->_table, ['title' => 'Грузовики', 'category_id' => 2]);
        $this->insert($this->_table, ['title' => 'Спецтехника', 'category_id' => 2]);
        $this->insert($this->_table, ['title' => 'Мото', 'category_id' => 2]);
        $this->insert($this->_table, ['title' => 'Автобусы', 'category_id' => 2]);
        $this->insert($this->_table, ['title' => 'Прицепы', 'category_id' => 2]);
        $this->insert($this->_table, ['title' => 'Водный транспорт', 'category_id' => 2]);
        $this->insert($this->_table, ['title' => 'Автодома', 'category_id' => 2]);
        $this->insert($this->_table, ['title' => 'Воздушный транспорт', 'category_id' => 2]);

        $this->insert($this->_table, ['title' => 'Аренда квартир', 'category_id' => 3]);
        $this->insert($this->_table, ['title' => 'Аренда земли', 'category_id' => 3]);
        $this->insert($this->_table, ['title' => 'Аренда комнат', 'category_id' => 3]);
        $this->insert($this->_table, ['title' => 'Аренда домов', 'category_id' => 3]);
        $this->insert($this->_table, ['title' => 'Аренда гаража', 'category_id' => 3]);
        $this->insert($this->_table, ['title' => 'Продажа квартир', 'category_id' => 3]);
        $this->insert($this->_table, ['title' => 'Продажа земли', 'category_id' => 3]);
        $this->insert($this->_table, ['title' => 'Продажа помещений', 'category_id' => 3]);
        $this->insert($this->_table, ['title' => 'Продажа гаража', 'category_id' => 3]);

        $this->insert($this->_table, ['title' => 'Антиквариат/коллекции', 'category_id' => 4]);
        $this->insert($this->_table, ['title' => 'Книги/журналы', 'category_id' => 4]);
        $this->insert($this->_table, ['title' => 'Музыкальные инструменты', 'category_id' => 4]);
        $this->insert($this->_table, ['title' => 'Спорт', 'category_id' => 4]);
        $this->insert($this->_table, ['title' => 'CD/DVD/пластинки/кассеты', 'category_id' => 4]);
        $this->insert($this->_table, ['title' => 'Билеты', 'category_id' => 4]);

        $this->insert($this->_table, ['title' => 'Перевозки/Аренда транспорта', 'category_id' => 5]);
        $this->insert($this->_table, ['title' => 'Сырьё/материалы', 'category_id' => 5]);
        $this->insert($this->_table, ['title' => 'Юридические услуги', 'category_id' => 5]);
        $this->insert($this->_table, ['title' => 'Строительство/ремонт/уборка', 'category_id' => 5]);
        $this->insert($this->_table, ['title' => 'Реклама/полиграфия', 'category_id' => 5]);
        $this->insert($this->_table, ['title' => 'Красота/здоровье', 'category_id' => 5]);
        $this->insert($this->_table, ['title' => 'Туризм', 'category_id' => 5]);
        $this->insert($this->_table, ['title' => 'Ремонт техники', 'category_id' => 5]);
        $this->insert($this->_table, ['title' => 'Прокат товаров', 'category_id' => 5]);
        $this->insert($this->_table, ['title' => 'Финансовые услуги', 'category_id' => 5]);
        $this->insert($this->_table, ['title' => 'Няни/сиделки', 'category_id' => 5]);
        $this->insert($this->_table, ['title' => 'Услуги переводчиков', 'category_id' => 5]);
        $this->insert($this->_table, ['title' => 'Сетевой маркетинг', 'category_id' => 5]);
    }

    public function safeDown()
    {
    }

}
