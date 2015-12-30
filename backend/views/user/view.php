<?php
/* @var $link yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

$this->title = 'Пользователи сайта';
Pjax::begin(['id' => 'tableData']);
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
                            'label' => 'Логин',
                            'value' => function ($model) {
                                return $model->username;
                            }
                        ],
                        [
                            'label' => 'Ф.И.О.',
                            'value' => function ($model) {
                                return $model->fio;
                            }
                        ],
                        [
                            'label' => 'Электронная почта',
                            'value' => function ($model) {
                                return $model->email;
                            }
                        ],
                        [
                            'label' => 'Телефон',
                            'value' => function ($model) {
                                return $model->phone;
                            }
                        ],
                        [
                            'label' => '',
                            'format' => 'raw',
                            'contentOptions' => [
                                'class' => 'text-left mnw250'
                            ],
                            'value' => function ($model) {
                                return \common\models\User::isBlock($model->username)?'<a href="'.Url::to('/user/unblock_user/' . $model->id).'" class="btn btn-mini btn-default">Разблокировать пользователя</a>':
                                    '<a href="'.Url::to('/user/block_user/' . $model->id).'" class="btn btn-mini btn-default">Заблокировать пользователя</a>';
                            }
                        ],
                        [
                            'label' => '',
                            'format' => 'raw',
                            'contentOptions' => [
                                'class' => 'text-left mnw250'
                            ],
                            'value' => function ($model) {
                                return  \common\models\User::isAdmin($model->username)?'<a href="'.Url::to('/user/deladmin/' . $model->id).'" class="btn btn-mini btn-default">Удалить статус администатора</a>':
                                    '<a href="'.Url::to('/user/setadmin/' . $model->id).'" class="btn btn-mini btn-default">Сделать администратором</a>';
                            }
                        ],
                    ]
                ]
            );
            ?>
        </div>
    </div>
<?php Pjax::end() ?>