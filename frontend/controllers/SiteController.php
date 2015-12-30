<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Category;
use common\models\Subcategory;
use common\models\PaymentPlans;
/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'oAuthSuccess'],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'home';
        $subcat = new Subcategory();
        $cat = Category::find()->all();
        $basicModel = PaymentPlans::findOne(['name' => 'Basic']);
        $advancedModel = PaymentPlans::findOne(['name' => 'Advanced']);
        $proModel = PaymentPlans::findOne(['name' => 'Pro']);
        return $this->render('index', compact('cat', 'subcat', 'basic', 'advanced', 'pro', 'basicModel', 'advancedModel', 'proModel'));
    }
}
