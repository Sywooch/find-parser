<?php
namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use common\models\User;
use common\models\Comments;
use yii\data\ActiveDataProvider;
/**
 * Comments controller
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

    public function actionDelete($id)
    {
        if (User::isAdmin(Yii::$app->user->identity->username)) {
            if (Comments::deleteAll(['id' => $id])) {
                return $this->redirect('/comments/view');
            } else {
                throw new ForbiddenHttpException('Ошибка удаления комментария!', 404);
            }
        } else {
            throw new ForbiddenHttpException('У вас нет прав администратора!', 404);
        }
    }

    public function actionView()
    {
        if (User::isAdmin(Yii::$app->user->identity->username)) {
            $link = new ActiveDataProvider([
                'query' => Comments::find(),
                'pagination' => ['pageSize' => 50]
            ]);

            return $this->render('view', compact('link'));
        } else {
            throw new ForbiddenHttpException('У вас нет прав администратора!', 404);
        }
    }
}
