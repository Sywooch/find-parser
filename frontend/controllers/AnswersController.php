<?php
namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use common\models\Answers;
/**
 * Comments controller
 */
class AnswersController extends Controller
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
    
    /**
     * Вывод новостей
     * @return string
     */
    public function actionIndex()
    {
        $news = Answers::find()->all();
        return $this->render('index', compact('news'));
    }
}
