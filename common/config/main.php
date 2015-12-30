<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'alphaSms' => [
            'class' => 'richweber\alpha\sms\AlphaSms',
            'sender' => 'Максим',
            'login' => '0676124113',
            'password' => '0673188966',
            'key' => 'd0642f4b340d8dce050bce04d20384b4c115ebbe'
        ],
    ],
];