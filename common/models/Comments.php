<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class Comments
 * @property integer $id
 * @property integer $user_id
 * @property string $text
 * @package common\models
 */
class Comments extends ActiveRecord
{
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['user_id'], 'integer'],
            [['text', 'user_id'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'text' => 'Текст сообщения'
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}