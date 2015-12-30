<?php
/* @var $link yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

$this->title = 'Комментарии пользователей';
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
                            'label' => 'Текст комментария',
                            'value' => function ($model) {
                                return $model->text;
                            }
                        ],
                        [
                            'label' => 'Логин пользователя',
                            'value' => function ($model) {
                                return $model->user->username;
                            }
                        ],
                        [
                            'label' => 'Время отправки',
                            'value' => function ($model) {
                                return $model->created_at;
                            }
                        ],
                        [
                            'label' => '',
                            'format' => 'raw',
                            'contentOptions' => [
                                'class' => 'text-left mnw250'
                            ],
                            'value' => function ($model) {
                                return '<a href="'.Url::to('/comments/delete/'.$model->id).'">Удалить комментарий</a>';
                            }
                        ]
                    ]
                ]
            );
            ?>
        </div>
    </div>
<?php Pjax::end() ?>