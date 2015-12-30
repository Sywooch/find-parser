<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class Sms
 * @property integer $id
 * @property string $text
 * @property integer $search_id
 * @property integer $item_id
 * @property integer $status
 * @package common\models
 */
class Sms extends ActiveRecord
{
    const STATUS_DELIVERED = 1;
    const STATUS_NOT_DELIVERED = 0;

    public function rules()
    {
        return [
            [['text'], 'string'],
            [['search_id'], 'integer'],
            [['item_id'], 'integer'],
            [['text', 'search_id', 'status', 'item_id'], 'required'],
            ['status', 'default', 'value' => self::STATUS_NOT_DELIVERED],
            ['status', 'in', 'range' => [self::STATUS_DELIVERED, self::STATUS_NOT_DELIVERED]],
        ];
    }

    public function attributeLabels()
    {
        return [
        ];
    }

    /**
     * Получение информации о поиске
     * @return \yii\db\ActiveQuery
     */
    public function getSearch()
    {
        return $this->hasOne(Searched::className(), ['search_id' => 'id']);
    }
}