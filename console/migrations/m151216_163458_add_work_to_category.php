<?php

use yii\db\Migration;

class m151216_163458_add_work_to_category extends Migration
{
    public function up()
    {
        $this->insert('category', ['title' => 'Работа']);
    }

    public function down()
    {
    }
}
