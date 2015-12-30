<?php
/* @var $this yii\web\View */
/* @var $basicModel \common\models\PaymentPlans */
/* @var $advancedModel \common\models\PaymentPlans */
/* @var $proModel \common\models\PaymentPlans */
$this->title = 'Тарифные планы';

use yii\helpers\Html;
use yii\helpers\Url;

?>


<div class="container">
    <div class="pages">
        <div class="row">


            <h2>Наши тарифные планы</h2>

            <div class="col-md-3 col-md-offset-1 serv-desc ">
                <p><b>Имя: </b>Стандартный</p>

                <p><b>Кол-во смс: </b><?= $basicModel->max_allow_sms ?></p>

                <p><b>Цена: </b>100 грн. в мес.</p>
                <?= $basic ?>
            </div>
            <div class="col-md-3 serv-desc ">
                <p><b>Имя: </b>Средний</p>

                <p><b>Кол-во смс: </b><?= $advancedModel->max_allow_sms ?></p>

                <p><b>Цена: </b>300 грн. в мес.</p>
                <?= $advanced ?>
            </div>
            <div class="col-md-3 serv-desc ">
                <p><b>Имя: </b>Максимальный</p>

                <p><b>Кол-во смс: </b><?= $proModel->max_allow_sms ?></p>

                <p><b>Цена: </b>450 грн. в мес.</p>
                <?= $pro ?>
            </div>

        </div>
    </div>
</div>
