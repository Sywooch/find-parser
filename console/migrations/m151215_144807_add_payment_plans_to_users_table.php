<?php

use yii\db\Migration;

class m151215_144807_add_payment_plans_to_users_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('searched', 'plan_id', $this->integer()->notNull());
        $this->addColumn('searched', 'date_expiration', $this->date()->notNull());
        $this->addColumn('users', 'balance', $this->float()->notNull()->defaultValue(0));
        $this->addForeignKey('user_to_plan', 'searched', 'plan_id', 'payment_plans', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('user_to_plan', 'searched');
        $this->dropColumn('searched', 'plan_id');
        $this->dropColumn('users', 'balance');
        $this->dropColumn('searched', 'date_expiration');
    }
}