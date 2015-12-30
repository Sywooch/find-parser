<?php
/* @var $this yii\web\View */
/* @var $model common\models\PaymentPlans */
/* @var $value common\models\PaymentPlans */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Редактирование тарифного плана';
$form = ActiveForm::begin();
?>

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <h1 class="text-center"> <?= $this->title . ' ' . $value->name ?></h1>

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-sign-in"></i><?= $this->title ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $form->field($model, 'name')->textInput(['value' => $value->name]) ?>
                            <?php echo $form->field($model, 'max_allow_sms')->textInput(['value' => $value->max_allow_sms]) ?>
                            <?php echo $form->field($model, 'price')->textInput(['value' => $value->price]) ?>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <?= Html::button(
                        'Применить', [
                            'type' => 'submit',
                            'class' => 'btn btn-success'
                        ]
                    ) ?>
                    <?= Html::a('Назад', Url::to('/plans/index'), ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
<?php
$form::end();
?>