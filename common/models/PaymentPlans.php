<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class PaymentPlans
 * @property integer $id
 * @property string $name
 * @property integer $max_allow_sms
 * @property integer $price
 * @package common\models
 */
class PaymentPlans extends ActiveRecord
{
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['max_allow_sms', 'integer'], 'integer'],
            [['name', 'max_allow_sms', 'price'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя тарифного плана',
            'max_allow_sms' => 'Максимальное кол-во смс',
            'price' => 'Цена'
        ];
    }
}