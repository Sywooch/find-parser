<?php
namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use common\models\Items;
use common\models\User;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use common\classes\olx\InitOlx;
use common\classes\comfy\ElectronikaComfy;
use common\classes\microtron\ElectronikaMicrotron;
use common\classes\allo\AlloParser;
use common\classes\rozetka\RozetkaParser;
use common\classes\foxmart\FoxmartParser;
use common\classes\rst\Rst;

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

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
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

    /**
     * Парсинг olx.ua данных и редирект на результат
     * @return \yii\web\Response
     */
    public function actionSave_olx()
    {
        set_time_limit(0);
        $olx = new InitOlx();
        $olx->initOlx();
        return $this->goHome();
    }

    /**
     * Парсинг comfy.ua данных и редирект на результат
     * @return \yii\web\Response
     */
    public function actionSave_comfy()
    {
        $parse = new ElectronikaComfy();
        $parse->initComfy();
        return $this->goHome();
    }

    /**
     * Парсинг foxtrot.com.ua данных
     * @return \yii\web\Response
     */
    public function actionSave_foxmart()
    {
        set_time_limit(0);
        FoxmartParser::parse();
        return $this->goHome();
    }

    /**
     * Парсинг microtron.com.ua данных
     * @return \yii\web\Response
     */
    public function actionSave_microtron()
    {
        $parse = new ElectronikaMicrotron();
        $parse->saveParseMicrotron();
        return $this->goHome();
    }

    public function actionSave_rst()
    {
        $parse = new Rst();
        $parse->init();
        return $this->goHome();
    }

    public function actionSave_rozetka()
    {
        set_time_limit(0);
        RozetkaParser::parse();
        return $this->goHome();
    }

    public function actionSave_allo()
    {
        set_time_limit(0);
        AlloParser::parse();
        return $this->goHome();
    }

    public function actionSave_auto_ria()
    {
        sleep(2);
        return $this->goHome();
    }

    public function actionSave_dom_ria()
    {
        sleep(2);
        return $this->goHome();
    }
}