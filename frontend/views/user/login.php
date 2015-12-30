<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
$form = ActiveForm::begin();

?>
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <h1 class="text-center">Приветствуем Вас на портале SISHIK.NET</h1>

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-sign-in"></i> <?= $this->title ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'username')->label(false)->textInput(['placeholder' => 'Логин']) ?>
                            <?= $form->field($model, 'password')->label(false)->passwordInput(['placeholder' => 'Пароль']) ?>
                            <?= $form->field($model, 'rememberMe')->checkbox() ?>
                            <div style="color:#999;margin:1em 0">
                                Забыли пароль? <?= Html::a('вспомнить', ['user/request-password-reset']) ?>.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <?= Html::button(
                        'Авторизироваться', [
                            'type' => 'submit',
                            'class' => 'btn btn-info'
                        ]
                    ) ?>
                </div>
                <?php
//                echo yii\authclient\widgets\AuthChoice::widget([
//                    'baseAuthUrl' => ['site/auth']
//                ]);
                ?>
            </div>
        </div>
    </div>
<?php
$form::end();
?>