<?php
namespace backend\controllers;

use common\models\Searched;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\data\ActiveDataProvider;
use common\models\User;
use yii\web\ForbiddenHttpException;

class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Вывод всех пользователей
     * @return string
     * @throws ForbiddenHttpException
     */
    public function actionView()
    {
        if(User::isAdmin(Yii::$app->user->identity->username)) {

            $link = new ActiveDataProvider([
                'query' => User::find(),
                'pagination' => ['pageSize' => 10]
            ]);
            return $this->render('view', compact('link'));
        } else {
            throw new ForbiddenHttpException('У вас нет прав администратора!', 404);
        }
    }

    public function actionSearched()
    {
        if(User::isAdmin(Yii::$app->user->identity->username)) {

            $link = new ActiveDataProvider([
                'query' => Searched::find(),
                'pagination' => ['pageSize' => 10]
            ]);
            return $this->render('searched', compact('link'));
        }else{
            throw new ForbiddenHttpException('У вас нет прав администратора!', 404);
        }
    }

    public function actionSetadmin($id){
        if(User::isAdmin(Yii::$app->user->identity->username)) {

            if (User::updateAll(['role' => User::ROLE_ADMIN], ['id' => $id])) {
                return $this->redirect('/user/view');
            } else {
                throw new ForbiddenHttpException('Ошибка установки статуса администратора!', 404);
            }
        } else {
            throw new ForbiddenHttpException('У вас нет прав администратора!', 404);
        }
    }

    public function actionDeladmin($id){
        if(User::isAdmin(Yii::$app->user->identity->username)) {

            if (User::updateAll(['role' => User::ROLE_USER], ['id' => $id])) {
                return $this->redirect('/user/view');
            } else {
                throw new ForbiddenHttpException('Ошибка удления статуса администратора!', 404);
            }
        } else {
            throw new ForbiddenHttpException('У вас нет прав администратора!', 404);
        }
    }

    public function actionBlock_user($id){
        if(User::isAdmin(Yii::$app->user->identity->username)) {

            if (User::updateAll(['status' => User::STATUS_DELETED], ['id' => $id])) {
                return $this->redirect('/user/view');
            } else {
                throw new ForbiddenHttpException('Ошибка блокирования пользователя!', 404);
            }
        } else {
            throw new ForbiddenHttpException('У вас нет прав администратора!', 404);
        }
    }

    public function actionUnblock_user($id)
    {
        if (User::isAdmin(Yii::$app->user->identity->username)) {

            if (User::updateAll(['status' => User::STATUS_ACTIVE], ['id' => $id])) {
                return $this->redirect('/user/view');
            } else {
                throw new ForbiddenHttpException('Ошибка разблокирования пользователя', 404);
            }
        } else{
            throw new ForbiddenHttpException('У вас нет прав администратора!', 404);
        }
    }
}