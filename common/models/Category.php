<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class Category
 * @property integer $id
 * @property string $title
 * @package common\models
 */
class Category extends ActiveRecord
{
    public function rules()
    {
        return [
            [['title'], 'string'],
            [['title'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
        ];
    }

    public static function setIcon(){

           return [
               '1'=>'camera',
               '2'=>'car',
               '3'=>'home',
               '4'=>'motorcycle',
               '5'=>'group',
               '6'=>'industry',
           ];

    }
}