<?php

use yii\db\Migration;

class m151205_193906_update_searching_table_url_to_text extends Migration
{
    public function up()
    {
        $this->dropColumn('searched', 'url');
        $this->addColumn('searched', 'url', $this->text()->notNull());
    }

    public function down()
    {
        $this->dropColumn('searched', 'url');
        $this->addColumn('searched', 'url', $this->string()->notNull());
    }
}
