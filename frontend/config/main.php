<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request'=>[
            'class' => 'common\components\Request',
            'web'=> '/frontend/web'
        ],
        'urlManager' => [
            'scriptUrl'=>'/index.php',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'user/profile' => 'user/profile',
                'user/register' => 'user/signup',
                'user/login' => 'user/login',
                'user/logout' => 'user/logout',
                'search' => 'parsing/search',
                'delete/<id:\d+>' => 'parsing/delete',
                'activate/<id:\d+>' => 'parsing/activate',
                'deactivate/<id:\d+>' => 'parsing/deactivate',
                'plans/set/<id:\d+>/<category_id:\d+>' => 'plans/set',
                'plans/transaction/<id:\d+>' => 'plans/transaction',
                'comments/save/<id:\d+>' => 'comments/save'
            ],
        ],'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
                    'clientId' => '446789768859315',
                    'clientSecret' => '49650bf959baa1b4ea20782e46cab928',
                ],
                'vkontakte' => [
                    'class' => 'yii\authclient\clients\VKontakte',
                    'clientId' => '5181309',
                    'clientSecret' => 'AE54T772rqWDlQP7xBo1',
              ]
            ],
        ],
    ],
    'params' => $params,
];
