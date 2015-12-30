<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class News
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @package common\models
 */
class News extends ActiveRecord
{
    public function rules()
    {
        return [
            [['title' ,'description', 'image'], 'string'],
            [['title'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
        ];
    }
}