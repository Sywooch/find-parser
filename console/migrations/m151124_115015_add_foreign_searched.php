<?php

use yii\db\Migration;

class m151124_115015_add_foreign_searched extends Migration
{
    public function up()
    {
        $this->addForeignKey('user_to_search', 'searched', 'user_id', 'users', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('user_to_search', 'searched');
    }
}
