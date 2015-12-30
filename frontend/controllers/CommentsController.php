<?php
namespace frontend\controllers;

use common\controllers\CommentsBaseController;
use Yii;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class CommentsController extends CommentsBaseController
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
