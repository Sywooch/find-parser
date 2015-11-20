<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use \frontend\models\Parse;
use yii\data\ActiveDataProvider;

/**
 * Parsing controller
 */
class ParsingController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'parser', 'save_olx'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['parser'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['save_olx'],
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

    /**
     * Рендер index страницы парсинга
     * @return string|\yii\web\Response
     */
    public function actionIndex(){
        return $this->render('index');
    }

    /**
     * Парсинг данных и редирект на результат
     * @return bool|\yii\web\Response
     */
    public function actionSave_olx(){
        if(Parse::saveParse()){
            return $this->redirect('parser');
        } else {
            return false;
        }
    }

    /**
     * Вывод результатов парсинга
     * @return string
     */
    public function actionParser(){
        $link = new ActiveDataProvider([
            'query' => Parse::find()->where([
                'user_id' => Yii::$app->user->id
            ]),
            'pagination' => ['pageSize' => 20]
        ]);
        return $this->render('parser', compact('link'));
    }
}