<?php
namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use common\models\Searched;
use common\models\Items;
use common\models\Sms;
use common\models\User;
use common\classes\urlcutter\GoogleUrlShortener;
use common\classes\sms\SmsClient;

/**
 * Parsing controller
 */
class ParsingController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    private function send(){
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


    /**
     * Вывод результатов парсинга
     * @return string
     */
    public function actionSearch()
    {
        if (!Yii::$app->user->isGuest) {
            if (Searched::uniqueSaveSearch(json_encode($_GET))) {
                $search = new Searched();
                $search->url = json_encode($_GET);
                $search->user_id = Yii::$app->user->id;
                $search->plan_id = '1';
                if ($search->save()) {
                    if(Yii::$app->user->identity->role == User::ROLE_GOD)
                    {
                        $link = new ActiveDataProvider([
                            'query' => Items::search($_GET),
                            'pagination' => ['pageSize' => 50]
                        ]);
                        return $this->render('search', compact('link'));
                    } else {
                        $url_data = json_decode($search->url, true);
                        return $this->redirect('/plans/set/' . $search->id . '/' . $url_data['category_id']);
                    }
                } else {
                    return $this->goHome();
                }
            } else {
                return $this->redirect('/user/profile');
            }
        } else {
            return $this->redirect('/user/register');
        }
    }

    /**
     * Удаление поискового запроса из базы
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        if($sms = Sms::deleteAll(['search_id' => $id])) {
            if ($model = Searched::deleteAll(['id' => $id, 'user_id' => Yii::$app->user->id])) {
                return $this->redirect('/user/profile');
            } else {
                return $this->redirect('/user/profile');
            }
        } else {
            if ($model = Searched::deleteAll(['id' => $id, 'user_id' => Yii::$app->user->id])) {
                return $this->redirect('/user/profile');
            } else {
                return $this->redirect('/user/profile');
            }
        }
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionActivate($id)
    {
        if (Searched::updateAll(
            [
                'status' => Searched::STATUS_ACTIVE
            ],
            [
                'id' => $id,
                'status' => Searched::STATUS_INACTIVE,
                'user_id' => Yii::$app->user->id
            ])
        ) {
            $this->send();
            return $this->redirect('/user/profile');
        } else {
            return $this->goHome();
        }
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDeactivate($id)
    {
        if (Searched::updateAll(
            [
                'status' => Searched::STATUS_INACTIVE
            ],
            [
                'id' => $id,
                'status' => Searched::STATUS_ACTIVE,
                'user_id' => Yii::$app->user->id
            ])
        ) {
            return $this->redirect('/user/profile');
        } else {
            return $this->goHome();
        }
    }



    public function actionSuccess()
    {
        return $this->render('success');
    }
}