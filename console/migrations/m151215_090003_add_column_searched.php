<?php
use yii\db\Migration;

class m151215_090003_add_column_searched extends Migration
{
    public function up()
    {
        $this->addColumn('searched', 'status', $this->smallInteger()->notNull()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('searched', 'status');
    }
}
