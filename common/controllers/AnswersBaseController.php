<?php
namespace common\controllers;

use yii\web\Controller;
use yii;
use yii\data\ActiveDataProvider;
use common\models\Answers;
use common\models\User;
use yii\web\ForbiddenHttpException;

class AnswersBaseController extends Controller
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

    /**
     * Вывод новостей
     * @return string
     */
    public function actionIndex()
    {
        $news = Answers::find()->all();
        return $this->render('index', compact('news'));
    }

    public function actionView()
    {
        if (User::isAdmin(Yii::$app->user->identity->username)) {
            $link = new ActiveDataProvider([
                'query' => Answers::find(),
                'pagination' => ['pageSize' => 50]
            ]);
            return $this->render('view', compact('link'));
        } else {
            throw new ForbiddenHttpException('У вас нет прав администратора!', 404);
        }
    }

    public function actionEdit($id)
    {
        if (User::isAdmin(Yii::$app->user->identity->username)) {
            $value = Answers::findOne($id);
            $model = new Answers();
            if (Yii::$app->request->isPost) {
                $item = Yii::$app->request->post('Answers');
                if (Answers::updateAll(['text' => $item['text'], 'answer' => $item['answer']], ['id' => $id])) {
                    return $this->redirect('/admin/answers/view');
                } else {
                    throw new ForbiddenHttpException('Ошибка обновления помощи', 404);
                }
            }
            return $this->render('edit', compact('model', 'value'));
        } else {
            throw new ForbiddenHttpException('У вас нет прав администратора!', 404);
        }
    }

    public function actionDelete($id)
    {
        if (User::isAdmin(Yii::$app->user->identity->username)) {
            if (Answers::deleteAll(['id' => $id])) {
                return $this->redirect('/admin/answers/view');
            } else {
                throw new ForbiddenHttpException('Ошибка добавления помощи', 404);
            }
        } else {
            throw new ForbiddenHttpException('У вас нет прав администратора!', 404);
        }
    }

    public function actionSave()
    {
        if (User::isAdmin(Yii::$app->user->identity->username)) {
            $model = new Answers();
            if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
                if ($model->save()) {
                    return $this->redirect('/admin/answers/view');
                }
            }
            return $this->render('save', compact('model'));
        } else {
            throw new ForbiddenHttpException('У вас нет прав администратора!', 404);
        }
    }
}