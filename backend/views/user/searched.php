<?php
/* @var $link yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;

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
                            'label' => 'Запрос',
                            'value' => function ($model) {
                                $url_data = json_decode($model->url, true);
                                if (!empty($url_data['text'])) {
                                    return $url_data['text'];
                                } else {
                                    $category = \common\models\Category::findOne($url_data['category_id']);
                                    return $category->title;
                                }
                            }
                        ],
                        [
                            'label' => 'Логин пользователя',
                            'value' => function ($model) {
                                return $model->user->username;
                            }
                        ],
                        [
                            'label' => 'Тарифный план',
                            'value' => function ($model) {
                                return $model->plan->name;
                            }
                        ],
                    ]
                ]
            );
            ?>
        </div>
    </div>
<?php Pjax::end() ?>