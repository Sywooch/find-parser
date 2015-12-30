<?php
/* @var $this yii\web\View */
/* @var $data common\models\User */
/* @var $link yii\data\ActiveDataProvider */
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\models\Searched;
use yii\bootstrap\Modal;

$this->title = 'Личный кабинет';
Pjax::begin(['id' => 'tableData'])
?>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-sign-in"></i>
                Личная информация
                <?= Html::a('Редактировать', \yii\helpers\Url::to('/user/edit'), ['class' => 'btn btn-default']) ?>
            </div>
            <div class="panel-body">
                <div class="col-sm-6 col-lg-6 col-md-6 col-xs-6">
                    <p><b>Логин:</b> <?= $data->username . '</br>' ?></p>

                    <p><b>Ф.И.О.:</b> <?= $data->fio . '</br>' ?></p>

                    <p><b>Телефон:</b> <?= $data->phone . '</br>' ?></p>

                    <p><b>Електронная почта:</b> <?= $data->email . '</br>' ?></p>
                </div>
                <div class="col-sm-6 col-lg-6 col-md-6 col-xs-6">
                    <p><b>Баланс: </b> <?= $data->balance . '</br>' ?></p>

                    <p>
                        <?= Html::a('Подать заявку', \yii\helpers\Url::to('/'), ['class' => 'btn btn-default']) ?>
                    </p>

                    <?php Modal::begin([
                        'header' => '<h2><i class="fa fa-send"></i>Отправить комментарий</h2>',
                        'toggleButton' => ['label' => 'Отправить комментарий', 'class' => 'btn btn-default'],
                    ]); ?>
                    <?= Html::beginForm('/comments/save', 'post', ['id' => 'form-parse', 'class' => 'form-inline']) ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?= Html::textarea('text', '', ['class' => 'form-control text-send']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <?= Html::button(
                                'Отправить комментарий', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-default'
                                ]
                            ) ?>
                        </div>
                    </div>
                    <?= Html::endForm() ?>
                    <?php Modal::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-sign-in"></i>Мои поиски</div>
            <div class="panel-body">
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
                                'label' => 'Категория',
                                'value' => function ($model) {
                                    $url_data = json_decode($model->url, true);
                                    $category = \common\models\Category::findOne($url_data['category_id']);
                                    return $category->title;
                                }
                            ],
                            [
                                'label' => 'Пользовательский текст',
                                'value' => function ($model) {
                                    $url_data = json_decode($model->url, true);
                                    if (!empty($url_data['text'])) {
                                        return $url_data['text'];
                                    } else {
                                        return "Не задан";
                                    }
                                }
                            ],
                            [
                                'label' => '',
                                'format' => 'raw',
                                'contentOptions' => [
                                    'class' => 'text-left mnw250'
                                ],
                                'value' => function ($model) {
                                    return '<a href="/delete/' . $model->id . '" class="btn btn-mini btn-default">Удалить поиск</a>';
                                }
                            ],
                            [
                                'label' => '',
                                'format' => 'raw',
                                'contentOptions' => [
                                    'class' => 'text-left mnw250'
                                ],
                                'value' => function ($model) {
                                    $url_data = json_decode($model->url, true);
                                    return Searched::isBuy($model->id) ? Searched::isActive($model->id)?'<a href="/deactivate/' . $model->id . '" class="btn btn-mini btn-default">Деактивировать смс рассылку</a>' : '<a href="/activate/' . $model->id . '" class="btn btn-mini btn-default">Активировать смс рассылку</a>':'<a href="'.\yii\helpers\Url::to('/plans/set/').$model->id.'/'.$url_data['category_id'].'" class="btn btn-mini btn-default">Активировать</a>';
                                }
                            ]
                        ]
                    ]
                );
                ?>
            </div>
        </div>
    </div>
<?php Pjax::end() ?>