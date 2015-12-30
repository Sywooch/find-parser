<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\User;

/**
 * Class Token
 * @property integer $user_id
 * @property string $key
 * @property string $device_id
 * @property string $device_os
 * @property string $device_token
 * @package common\models
 */
class Token extends ActiveRecord
{
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['user_id', 'key'], 'required'],
            [['key', 'device_id', 'device_os', 'device_token'], 'string'],
        ];
    }

    /**
     * Генерация ключа
     * @param $size
     * @return string
     */
    public static function randomKey($size)
    {
        do {
            $key = openssl_random_pseudo_bytes($size, $strongEnough);
        } while (!$strongEnough);
        $key = str_replace('+', '', base64_encode($key));
        $key = str_replace('/', '', $key);

        return base64_encode($key);
    }

    /**
     * Удаление токена
     * @param $token
     * @throws \Exception
     */
    public function deleteToken($token)
    {
        if ($model = self::findOne(['key' => $token])) {
            $model->delete();
        }
    }

    /**
     * Создание токена
     * @return Token
     */
    public function generateToken()
    {
        $token = new self();
        $token->key = self::randomKey(32);
        return $token;
    }

    /**
     * Проверка, существует ли токен
     * @param $token
     * @return bool
     */
    public function isIssetToken($token){
        if(self::findOne(['key' => $token])){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Получение пользователя по $id
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}