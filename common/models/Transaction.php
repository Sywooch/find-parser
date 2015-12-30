<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\User;

/**
 * Class Transaction
 * @property integer $id
 * @property integer $id_user
 * @property integer $search_id
 * @property string $success
 * @package common\models
 */
class Transaction extends ActiveRecord
{
    public function rules()
    {
        return [

            [['success'], 'string'],
            [['id_user', 'search_id'], 'integer'],
            [['success', 'id_user', 'search_id'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
        ];
    }

    public static function saveTransaction ($success, $id){
        $transaction = new self;
        if($success){
            $transaction->id_user = Yii::$app->user->id;
            $transaction->success = $success;
            $transaction->search_id = $id;
            $transaction->save();
        }
    }

    public function getUser(){
        return $this->hasOne(User::className(), ['id_user' => 'id']);
    }

    public function getSearch(){
        return $this->hasOne(Searched::className(), ['search_id' => 'id']);
    }
}