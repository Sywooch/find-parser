<?php
namespace backend\controllers;

use common\controllers\CommentsBaseController;
use Yii;
use yii\filters\VerbFilter;

/**
 * Comments controller
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
