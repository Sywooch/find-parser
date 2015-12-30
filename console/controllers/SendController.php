<?php
namespace console\controllers;

use yii\console\Controller;
use common\models\Searched;
use common\models\Items;
use common\models\Sms;
use common\classes\sms\SmsClient;

class SendController extends Controller
{
    public function actionIndex()
    {
        $dataSender = null;
        $searched = Searched::find()->where(['status' => Searched::STATUS_ACTIVE])->andWhere(['!=', 'plan_id', '1'])->all();
        foreach ($searched as $search) {
            $items = Items::search(json_decode($search->url, true))->limit($search->plan->max_allow_sms)->all();
            foreach ($items as $item) {
                $sms = new SmsClient('0676124113', '0673188966');
                $id = $sms->sendSMS('Sishik.net', $search->user->phone, 'Ваш товар найден: ' . $item->url);
                if ($sms->hasErrors()) {
                    var_dump($sms->getErrors());
                } else {
                    $sms = new Sms();
                    $sms->search_id = $search->id;
                    $sms->text = 'Ваш товар найден: ' . $item->url;
                    $sms->status = Sms::STATUS_DELIVERED;
                    $sms->save();
                }
            }
        }
    }
}