<?php
namespace frontend\controllers;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\PaymentPlans;
use yii\web\Controller;
use delagics\liqpay\LiqPay;
use yii;
use common\models\Searched;
use common\models\Transaction;
use common\models\Items;
use common\models\Sms;
use common\classes\urlcutter\GoogleUrlShortener;
use common\classes\sms\SmsClient;
class PlansController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionSet($id, $category_id)
    {
        if($category_id == '2'){
            $basicModel = PaymentPlans::findOne(['name' => 'BasicElectronic']);
            $advancedModel = PaymentPlans::findOne(['name' => 'AdvancedElectronic']);
            $proModel = PaymentPlans::findOne(['name' => 'ProElectronic']);
        } else {
            if($category_id == '3'){
                $basicModel = PaymentPlans::findOne(['name' => 'BasicTransport']);
                $advancedModel = PaymentPlans::findOne(['name' => 'AdvancedTransport']);
                $proModel = PaymentPlans::findOne(['name' => 'ProTransport']);
            } else {
                $basicModel = PaymentPlans::findOne(['name' => 'Basic']);
                $advancedModel = PaymentPlans::findOne(['name' => 'Advanced']);
                $proModel = PaymentPlans::findOne(['name' => 'Pro']);
            }
        }
        $liqpay = new LiqPay('i3673026691', '3fOw8EDMYgscpvSO8XkmIuAWmV5vkwBcE7FUV9h0');
        $basic = $liqpay->cnb_form( [
            'version'        => '3',
            'phone'          => Yii::$app->user->identity->phone,
            'amount'         => $basicModel->price,
            'currency'       => 'UAH',
            'description'    => $basicModel->id,
            'order_id'       => Yii::$app->security->generateRandomString(),
            'server_url'     => 'http://sishik.net/plans/transaction/' . $id,
            'result_url'     => 'http://sishik.net/user/profile',
        ]);
        $advanced = $liqpay->cnb_form( [
            'version'        => '3',
            'phone'          => Yii::$app->user->identity->phone,
            'amount'         => $advancedModel->price,
            'currency'       => 'UAH',
            'description'    => $advancedModel->id,
            'order_id'       => Yii::$app->security->generateRandomString(),
            'server_url'     => 'http://sishik.net/plans/transaction/' . $id,
            'result_url'     => 'http://sishik.net/user/profile'
        ]);
        $pro = $liqpay->cnb_form([
            'version'        => '3',
            'phone'          => Yii::$app->user->identity->phone,
            'amount'         => $proModel->price,
            'currency'       => 'UAH',
            'description'    => $proModel->id,
            'order_id'       => Yii::$app->security->generateRandomString(),
            'server_url'     => 'http://sishik.net/plans/transaction/' . $id,
            'result_url'     => 'http://sishik.net/user/profile'
        ]);
        return $this->render('set', compact('basic', 'advanced', 'pro', 'basicModel', 'advancedModel', 'proModel'));
    }

    protected function send()
    {
        $dataSender = null;
        $cutter = new GoogleUrlShortener();
        $searched = Searched::find()->where(['status' => Searched::STATUS_ACTIVE])->andWhere(['!=', 'plan_id', '1'])->all();
        foreach ($searched as $search) {
            $smsActive = Sms::find()->select('item_id')->where(['search_id' => $search->id])->all();
            $data = json_decode($search->url, true);
            $arr = [];
            foreach($smsActive as $item){ $arr[] = $item->item_id; }
            $data['exclude_id'] = $arr;
            $count_sms = Yii::$app->db->createCommand('SELECT * FROM sms WHERE search_id = '.$search->id.' AND CAST(created_at as DATE) = CAST(NOW() as DATE)')->execute();
            $items = Items::search($data)->limit($search->plan->max_allow_sms - $count_sms)->all();
            foreach ($items as $item) {
                $sms = new SmsClient('0676124113', '0673188966');
                $smsBody = 'Ваш товар найден: ' . $cutter->shorten($item->url) . ( ($item->phone)?(' Тел. ' . $item->phone):'');
                $id = $sms->sendSMS('Sishik.net', $search->user->phone, $smsBody);
                if ($sms->hasErrors()) {
                    var_dump($sms->getErrors());
                } else {
                    $sms = new Sms();
                    $sms->search_id = $search->id;
                    $sms->text = $smsBody;
                    $sms->status = Sms::STATUS_DELIVERED;
                    $sms->item_id = $item->id;
                    $sms->save();
                }
            }
        }
    }

    public function actionTransaction($id)
    {
        $result = Yii::$app->request->post();
        $json_data = base64_decode($result['data']);
        $data = json_decode($json_data, true);
        if($data){
            Transaction::saveTransaction($data, $id);
        }
        if($data['status'] === 'success'){
            $this->send();
            if($model = Searched::updateAll(['plan_id' => $data['description']], ['id' => $id])){
                return $this->redirect('/user/profile');
            } else {
                return $this->goHome();
            }
        } else {
            return $this->goHome();
        }
    }

    public function actionSend()
    {
        $this->send();
    }
}