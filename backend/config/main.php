<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
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
            'web'=> '/backend/web'
        ],
        'urlManager' => [
            'scriptUrl'=>'/backend/index.php',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'plans/edit/<id:\d+>' => 'plans/edit',

                'comments/delete/<id:\d+>' => 'comments/delete',

                'news/delete/<id:\d+>' => 'news/delete',
                'news/edit/<id:\d+>' => 'news/edit',

                'answers/delete/<id:\d+>' => 'answers/delete',
                'answers/edit/<id:\d+>' => 'answers/edit',

                'user/setadmin/<id:\d+>' => 'user/setadmin',
                'user/deladmin/<id:\d+>' => 'user/deladmin',

                'user/block_user/<id:\d+>' => 'user/block_user',
                'user/unblock_user/<id:\d+>' => 'user/unblock_user',
            ],
        ],
    ],
    'params' => $params,
];
