<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\News */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\tinymce\TinyMce;

$this->title = 'Добавление в раздел "Помощь"';
$form = ActiveForm::begin();

?>
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-sign-in"></i> <?= $this->title ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'text')->widget(TinyMce::className(), [
                                'options' => ['rows' => 6],
                                'language' => 'ru',
                                'clientOptions' => [
                                    'plugins' => [
                                        "advlist autolink lists link charmap print preview anchor",
                                        "searchreplace visualblocks code fullscreen",
                                        "insertdatetime media table contextmenu paste"
                                    ],
                                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                                ]
                            ]);?>
                            <?= $form->field($model, 'answer')->widget(TinyMce::className(), [
                                'options' => ['rows' => 6],
                                'language' => 'ru',
                                'clientOptions' => [
                                    'plugins' => [
                                        "advlist autolink lists link charmap print preview anchor",
                                        "searchreplace visualblocks code fullscreen",
                                        "insertdatetime media table contextmenu paste"
                                    ],
                                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                                ]
                            ]);?>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <?= Html::button(
                        'Добавить', [
                            'type' => 'submit',
                            'class' => 'btn btn-info'
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </div>
<?php
$form::end();
?>