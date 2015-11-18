<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\User;

/**
 * Class Olx
 * @package frontend\models
 *
 */
class Olx extends ActiveRecord
{
    public function rules()
    {
        return [
            [['product', 'price', 'url', 'user_id'], 'required'],
            [['product', 'price', 'url'], 'string'],
            [['user_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
        ];
    }

    /**
     * Пользователь, пославший запрос
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
