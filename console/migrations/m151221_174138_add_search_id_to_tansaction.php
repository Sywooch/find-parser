<?php

use yii\db\Migration;

class m151221_174138_add_search_id_to_tansaction extends Migration
{
    public function safeUp()
    {
        $this->addColumn('transaction', 'search_id', $this->integer()->notNull());
        $this->addForeignKey('transaction_to_search', 'transaction', 'search_id', 'searched', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('transaction_to_search', 'transaction');
        $this->dropColumn('transaction', 'search_id');
    }
}
