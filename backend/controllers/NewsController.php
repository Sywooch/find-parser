<?php
namespace backend\controllers;

use common\controllers\CommentsBaseController;
use common\controllers\NewsBaseController;
use Yii;
use yii\filters\VerbFilter;

/**
 * Comments controller
 */
class NewsController extends NewsBaseController
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
