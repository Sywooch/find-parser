<?php
namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use common\models\Comments;
use yii\web\ForbiddenHttpException;

/**
 * Site controller
 */
class CommentsController extends Controller
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

    public function actionSave()
    {
        $comment = new Comments();
        if (Yii::$app->request->isPost) {
            $comment->text = Yii::$app->request->post('text');
            $comment->user_id = Yii::$app->user->id;
            if ($comment->save()) {
                return $this->redirect('/user/profile');
            } else {
                throw new ForbiddenHttpException('Ошибка сохранения комментария!', 404);
            }
        } else {
            return $this->goHome();
        }
    }
}
