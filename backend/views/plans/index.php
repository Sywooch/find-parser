<?php
/* @var $this yii\web\View */
/* @var $model \common\models\PaymentPlans */

$this->title = 'Планы и их редактироване';

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="container">
    <h1><?= $this->title ?></h1>
    <div class="row">
        <?php foreach($model as $plan){ ?>
        <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
            <p><b>Имя: </b><?= $plan->name ?></p>
            <p><b>Максимальное кол-во смс: </b><?= $plan->max_allow_sms ?></p>
            <p><b>Цена: </b><?= $plan->price ?></p>
            <?= Html::a('Редактировать ' . $plan->name, Url::to('/admin/plans/edit/' . $plan->id), ['class' => 'btn btn-primary']) ?>
        </div>
        <?php } ?>
    </div>
</div>
