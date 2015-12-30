<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class Answers
 * @property integer $id
 * @property string $answer
 * @property string $text
 * @package common\models
 */
class Answers extends ActiveRecord
{
    public function rules()
    {
        return [
            [['answer' ,'text'], 'string'],
            [['answer', 'text'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            "answer"  => "Ответ",
            "text"  => "Вопрос",
        ];
    }
}