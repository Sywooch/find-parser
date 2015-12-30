<?php
namespace frontend\controllers;

use common\controllers\SiteBaseController;
use Yii;

/**
 * Site controller
 */
class SiteController extends SiteBaseController
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'oAuthSuccess'],
            ],
        ];
    }

    public function oAuthSuccess($client)
    {
        // get user data from client
        $userAttributes = $client->getUserAttributes();

//        print_r($userAttributes); exit;

        // do some thing with user data. for example with $userAttributes['email']
    }
}
