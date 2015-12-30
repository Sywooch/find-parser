<?php
/* @var $link yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;

$this->title = 'Новости на сайте';
Pjax::begin(['id' => 'tableData']);


    echo Html::a('<i class="fa fa-plus"></i> Добавить новость', \yii\helpers\Url::to('/admin/news/save'), ['class' => 'btn btn-default btn-sm ml10']);
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
                            'label' => '№',
                            'value' => function ($model) {
                                return $model->id;
                            }
                        ],
                        [
                            'label' => 'Заголовок',
                            'value' => function ($model) {
                                return $model->title;
                            }
                        ],
                        [
                            'label' => '',
                            'format' => 'raw',
                            'contentOptions' => [
                                'class' => 'text-left mnw250'
                            ],
                            'value' => function ($model) {
                                return '<a href="/admin/news/delete/' . $model->id . '" class="btn btn-mini btn-default">Удалить новость</a>';
                            }
                        ],
                        [
                            'label' => '',
                            'format' => 'raw',
                            'contentOptions' => [
                                'class' => 'text-left mnw250'
                            ],
                            'value' => function ($model) {
                                return '<a href="/admin/news/edit/' . $model->id . '" class="btn btn-mini btn-default">Редактировать новость</a>';
                            }
                        ],

                    ]
                ]
            );
            ?>
        </div>
    </div>
<?php Pjax::end() ?>