<?php
namespace common\controllers;

use common\models\Comments;
use common\models\User;
use yii\web\Controller;
use yii;
use yii\data\ActiveDataProvider;
use yii\web\ForbiddenHttpException;

class CommentsBaseController extends Controller
{
    /**
     * @param yii\base\Action $action
     * @return bool
     * @throws yii\web\BadRequestHttpException
     */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
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

    public function actionDelete($id)
    {
        if (User::isAdmin(Yii::$app->user->identity->username)) {
            if (Comments::deleteAll(['id' => $id])) {
                return $this->redirect('/admin/comments/view');
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