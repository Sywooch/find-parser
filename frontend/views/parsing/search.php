<?php
/* @var $link yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

$this->title = 'Search';
Pjax::begin(['id' => 'tableData'])
?>
    <div class="site-parser-data">
        <div class="row">
            <?= GridView::widget([
                    'id' => 'tableData',
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
                            'label' => 'Product',
                            'value' => function ($model) {
                                return $model->product;
                            }
                        ],
                        [
                            'label' => 'Url',
                            'value' => function ($model) {
                                return $model->url;
                            }
                        ],
                        [
                            'label' => 'Store',
                            'value' => function ($model) {
                                return $model->store;
                            }
                        ],
                        [
                            'label' => 'Price',
                            'value' => function ($model) {
                                return $model->price;
                            }
                        ],
                        [
                            'label' => 'Options',
                            'value' => function ($model) {
                                return $model->options;
                            }
                        ],
                        [
                            'label' => 'Created at',
                            'value' => function ($model) {
                                return $model->created_at;
                            }
                        ],
                    ]
                ]
            );
            ?>
        </div>
    </div>
<?php Pjax::end() ?>