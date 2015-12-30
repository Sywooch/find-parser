<?php

use yii\db\Migration;

class m151211_105316_refactor_price_to_float extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('items', 'price', $this->float()->notNull());
    }

    public function safeDown()
    {
        $this->alterColumn('items','price','float');
    }
}
