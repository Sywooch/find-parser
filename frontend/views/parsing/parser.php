<?php
/* @var $link yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Результаты парсинга';
?>

<div class="site-parser-data">
    <div class="row">
        <?= GridView::widget([
                'dataProvider' => $link,
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
                        'value' => function($model){
                            return $model->product;
                        }
                    ],
                    [
                        'label' => 'Цена',
                        'value' => function($model){
                            return $model->price;
                        }
                    ],
                    [
                        'label' => 'Магазин',
                        'value' => function($model){
                            return $model->magazine;
                        }
                    ],
                    [
                        'label' => 'Ссылка на оригинал',
                        'format' => 'raw',
                        'contentOptions' => [
                            'class' => 'text-right mnw250'
                        ],
                        'value' => function($model){
                            return
                                Html::a(
                                    $model->magazine,
                                    [
                                        $model->url,
                                    ],
                                    [
                                        'class' => 'btn btn-default'
                                    ]
                                );
                        }
                    ]
                ]
            ]
        );
        ?>
    </div>
</div>
