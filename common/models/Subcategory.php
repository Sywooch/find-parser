<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class Subcategory
 * @property string $title
 * @property string $options
 * @property integer $category_id
 * @package common\models
 */
class Subcategory extends ActiveRecord
{
    public function rules()
    {
        return [
            [['title', 'options'], 'string'],
            [['category_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
        ];
    }

    /**
     * Получить подкатегории по id категории
     * @param $id
     * @return array|bool|\yii\db\ActiveRecord[]
     */
    public function categoryGet($id){
        $model = self::find()->where(['category_id' => $id])->all();
        if($model){
            return $model;
        } else {
            return false;
        }
    }

    /**
     * Получить категорию
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}