<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class Searched
 * @property string $url
 * @property integer $user_id
 * @property integer $plan_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @package frontend\models
 */
class Searched extends ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'string'],
            [['user_id', 'plan_id'], 'integer'],
            [['url', 'user_id', 'plan_id'], 'required'],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [

        ];
    }

    /**
     * Не сохранять повторный поиск
     * @param $url
     * @return bool
     */
    public static function uniqueSaveSearch($url)
    {
        $model = self::find()->where([
            'url' => $url
        ])->one();
        if ($model) {
            return false;
        } else {
            return true;
        }
    }

    public static function isBuy($id){
        $search = self::find()
            ->where(['id' => $id])
            ->andWhere(['!=', 'plan_id', '1'])
            ->count();
        if($search){
            return true;
        } else {
            return false;
        }
    }

    public static function isActive($id){
        $search = self::find()
            ->where(['id' => $id])
            ->andWhere(['status' => 1])
            ->count();
        if($search){
            return true;
        } else {
            return false;
        }
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getPlan()
    {
        return $this->hasOne(PaymentPlans::className(), ['id' => 'plan_id']);
    }


}
