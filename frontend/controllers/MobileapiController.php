<?php namespace frontend\controllers;

use common\controllers\PlansBaseController;
use common\controllers\UserBaseController;
use common\models\Category;
use common\models\LoginForm;
use common\models\Searched;
use common\models\SignupForm;
use common\models\Subcategory;
use common\models\User;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class MobileapiController extends Controller {

    public function init() {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        parent::init();
    }

    public $allowActions = [
        'mobileapi/login',
        'mobileapi/register',

        'mobileapi/categories',
    ];

    public function beforeAction($action) {

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 86400");

        $action = \Yii::$app->controller->action->uniqueId;
        $request = \Yii::$app->request;
        $auth_key = $request->get('auth_key', false);

        if(in_array($action, $this->allowActions)) {
        } else if($auth_key && $user = User::find()->where(['auth_key' => $auth_key])->one()) {
            \Yii::$app->user->login($user);
        } else {
            throw new ForbiddenHttpException('Login please', 404);
        }

        return parent::beforeAction($action);
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return \Yii::$app->user->identity;
        }

        /**
         * @var User $model
         */
        $model = User::find()
            ->where([
                'phone' => \Yii::$app->request->get('phone')
            ])
            ->one();

//        return[ $model];
        if ($model && $model->validatePassword(\Yii::$app->request->get('password'))) {

            if(!$model->auth_key){
                $model->auth_key = \Yii::$app->security->generateRandomString();
                $model->save();
            }
            return $model;
        } else {
            return ['result' => false];
        }
    }
    public function actionRegister() {
        $user = new User();
        $user->username = \Yii::$app->request->get('username');
        $user->fio = \Yii::$app->request->get('fio');
        $user->email = \Yii::$app->request->get('email');
        $user->phone = \Yii::$app->request->get('phone');
        $user->created_at = new \DateTime();
        $user->updated_at = new \DateTime();
        $user->generateAuthKey();
        $user->setPassword(\Yii::$app->request->get('password'));

        $user->status  = 1;
        $user->role    = 1;

        if($user->save(false)) {
            return $user;
        }
        return ['result' => false];
    }

    public function actionRequest() {
        unset($_GET['auth_key']);
        if (Searched::uniqueSaveSearch(json_encode($_GET))) {
            $search = new Searched();
            $search->url = json_encode($_GET);
            $search->user_id = \Yii::$app->user->id;
            $search->plan_id = '1';
            if ($search->save()) {
//                $url_data = json_decode($search->url, true);
                return ['result' => 'success'];
            } else {
                return ['result' => 'not_saved'];
            }
        }

        return ['result' => 'not_unique'];

    }


    // Lists
    public function actionCategories() {
        return Subcategory::find()->all();
    }

}