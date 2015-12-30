<?php

use yii\db\Migration;

class m151126_180240_add_options_subcategory extends Migration
{
    public function up()
    {
        $this->addColumn('subcategory', 'options', $this->string()->notNull());
    }

    public function down()
    {
        $this->dropColumn('subcategory', 'options');
    }
}
