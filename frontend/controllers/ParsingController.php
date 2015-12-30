<?php
namespace frontend\controllers;

use common\controllers\ParsingBaseController;
use Yii;
use yii\filters\VerbFilter;

/**
 * Parsing controller
 */
class ParsingController extends ParsingBaseController
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
}