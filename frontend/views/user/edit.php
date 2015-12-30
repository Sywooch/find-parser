<?php
/* @var $this yii\web\View */
/* @var $model common\models\User */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = '';
$form = ActiveForm::begin();
?>

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <h1 class="text-center">Редактирование личных данных</h1>

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-sign-in"></i><?= $this->title ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'username')->textInput(['value' => Yii::$app->user->identity->username]) ?>
                            <?= $form->field($model, 'fio')->textInput(['value' => Yii::$app->user->identity->fio]) ?>
                            <?= $form->field($model, 'email')->textInput(['value' => Yii::$app->user->identity->email]) ?>
                            <?= $form->field($model, 'phone')->textInput(['value' => Yii::$app->user->identity->phone]) ?>
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
                    <?= Html::a('Назад', Url::to('/user/profile'), ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
<?php
$form::end();
?>