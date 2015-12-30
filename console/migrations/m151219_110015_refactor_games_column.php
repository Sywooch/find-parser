<?php

use yii\db\Migration;

class m151219_110015_refactor_games_column extends Migration
{
    public function up()
    {
        $this->update('subcategory', ['title' => 'Игровые приставки'], ['id' => 5]);
    }

    public function down()
    {
    }
}
