<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$form = ActiveForm::begin(['id' => 'form-signup']);
?>
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <h1 class="text-center">Приветствуем Вас на портале SISHIK.NET</h1>

        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-sign-in"></i> <?= $this->title ?></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'username') ?>
                        <?= $form->field($model, 'fio') ?>
                        <?= $form->field($model, 'email') ?>
                        <?= $form->field($model, 'phone') ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>

                    </div>
                </div>
            </div>
            <div class="panel-footer text-center">
                <?= Html::button(
                    'Зарегистироваться', [
                        'type' => 'submit',
                        'class' => 'btn btn-info'
                    ]
                ) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
