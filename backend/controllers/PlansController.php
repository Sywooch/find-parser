<?php
namespace backend\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use common\models\PaymentPlans;
use yii;
use yii\web\ForbiddenHttpException;
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

    /**
     * @param $id
     * @return string|yii\web\Response
     * @throws ForbiddenHttpException
     */
    public function actionEdit($id)
    {
        if(User::isAdmin(Yii::$app->user->identity->username)) {
            $model = new PaymentPlans();
            $value = PaymentPlans::findOne($id);
            if (Yii::$app->request->isPost) {
                $item = Yii::$app->request->post('PaymentPlans');
                if ($plan = PaymentPlans::updateAll(['name' => $item['name'], 'max_allow_sms' => $item['max_allow_sms'], 'price' => $item['price']], ['id' => $id])) {
                    return $this->redirect('/plans/index');
                } else {
                    throw new ForbiddenHttpException('Ошибка обновление тарифного плана!', 404);
                }
            }
            return $this->render('edit', compact('model', 'value'));
        } else {
            throw new ForbiddenHttpException('У вас нет прав администратора!', 404);
        }
    }

    /**
     * @return string
     * @throws ForbiddenHttpException
     */
    public function actionIndex()
    {
        if(User::isAdmin(Yii::$app->user->identity->username)) {
            $model = PaymentPlans::find()->where(['!=', 'name', 'Free'])->all();
            return $this->render('index', compact('model'));
        } else {
            throw new ForbiddenHttpException('У вас нет прав администратора!', 404);
        }
    }
}