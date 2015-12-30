<?php
namespace common\controllers;

use yii\web\Controller;
use common\models\Category;
use common\models\Subcategory;
use delagics\liqpay\LiqPay;
use common\models\PaymentPlans;
use yii;
class SiteBaseController extends Controller
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