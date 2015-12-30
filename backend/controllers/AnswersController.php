<?php
namespace backend\controllers;

use common\controllers\AnswersBaseController;
use Yii;
use yii\filters\VerbFilter;

/**
 * Comments controller
 */
class AnswersController extends AnswersBaseController
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
