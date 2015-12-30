<?php
/* @var $link yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Результаты поиска';
Pjax::begin(['id' => 'tableData'])
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
                            'label' => 'Наименование',
                            'value' => function ($model) {
                                return $model->product;
                            }
                        ],
                        [
                            'label' => 'Цена',
                            'value' => function ($model) {
                                return $model->price . ' грн';
                            }
                        ],
                        [
                            'label' => 'Магазин',
                            'value' => function ($model) {
                                return $model->store;
                            }
                        ],
                        [
                            'label' => 'Ссылка на оригинал',
                            'format' => 'raw',
                            'contentOptions' => [
                                'class' => 'text-left mnw250'
                            ],
                            'value' => function ($model) {
                                return '<a href="' . $model->url . '">' . $model->url . '</a>';
                            }
                        ]
                    ]
                ]
            );
            ?>
        </div>
    </div>
<?php Pjax::end() ?>