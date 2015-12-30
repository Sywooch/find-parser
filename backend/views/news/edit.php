<?php
/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $value common\models\News */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use dosamigos\tinymce\TinyMce;
$this->title = 'Редактирование новости';
$form = ActiveForm::begin();
?>

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-send"></i><?= $this->title ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'title')->textInput(['value' => $value->title]) ?>
                            <?= $form->field($model, 'description')->widget(TinyMce::className(), [
                                'options' => [
                                    'rows' => 6,
                                    'value' => $value->description
                                ],
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
                        'Редактировать', [
                            'type' => 'submit',
                            'class' => 'btn btn-success'
                        ]
                    ) ?>
                    <?= Html::a('Назад', Url::to('/news/view'), ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
<?php
$form::end();
?>