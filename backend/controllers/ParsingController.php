<?php
namespace backend\controllers;

use common\controllers\ParsingBaseController;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use common\models\Items;
use common\models\User;
use yii\web\ForbiddenHttpException;

/**
 * Parsing controller
 */
class ParsingController extends ParsingBaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['save_olx', 'save_comfy', 'save_foxtrot'],
                'rules' => [
                    [
                        'actions' => ['save_olx'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['save_comfy'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['save_foxtrot'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if(User::isAdmin(Yii::$app->user->identity->username)) {
            $link = new ActiveDataProvider([
                'query' => Items::find(),
                'pagination' => ['pageSize' => 50]
            ]);
            return $this->render('index', compact('link'));
        } else {
            throw new ForbiddenHttpException('У вас нет прав администратора!', 404);
        }
    }
}