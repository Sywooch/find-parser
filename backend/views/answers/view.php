<?php
/* @var $link yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Помощь на сайте';
Pjax::begin(['id' => 'tableData']);


echo Html::a('<i class="fa fa-plus"></i> Добавить', Url::to('/answers/save'), ['class' => 'btn btn-default btn-sm ml10']);
?>


    <div class="site-parser-data">
        <div class="row">
            <?= GridView::widget([
                    'id' => 'tableData',
                    'dataProvider' => $link,
                    'summary' => false,
                    'tableOptions' => [
                        'class' => 'table table-striped table-responsive'
                    ],
                    'columns' => [
                        [
                            'label' => 'Вопрос',
                            'value' => function ($model) {
                                return strip_tags($model->text);
                            }
                        ],
                        [
                            'label' => 'Ответ',
                            'value' => function ($model) {
                                return strip_tags($model->answer);
                            }
                        ],
                        [
                            'label' => '',
                            'format' => 'raw',
                            'contentOptions' => [
                                'class' => 'text-left mnw250'
                            ],
                            'value' => function ($model) {
                                return '<a href="' . Url::to('/answers/delete/'.$model->id ) . '" class="btn btn-mini btn-default">Удалить</a>';
                            }
                        ],
                        [
                            'label' => '',
                            'format' => 'raw',
                            'contentOptions' => [
                                'class' => 'text-left mnw250'
                            ],
                            'value' => function ($model) {
                                return '<a href="' . Url::to('/answers/edit/'.$model->id ). '" class="btn btn-mini btn-default">Редактировать</a>';
                            }
                        ],

                    ]
                ]
            );
            ?>
        </div>
    </div>
<?php Pjax::end() ?>