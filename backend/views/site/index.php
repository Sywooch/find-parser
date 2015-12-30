<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use common\models\Items;

$this->title = 'Обновить базу';
?>

<div class="body-content">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="lead" align="center">Sishik.net</div>
            <div id="loader"></div>
            <table class="table">
                <tr>
                    <th>Название магазина</th>
                    <th>Обновление</th>
                    <th>Количество товаров</th>
                    <th>Дата последнего обновления</th>
                </tr>
                <tr>
                    <td>Olx</td>
                    <td><?= Html::button('Обновить базу olx.ua', ['class' => 'btn btn-primary', 'id' => 'olx-button']) ?></td>
                    <td>
                        <?= 'Електроника - ' . Items::getColOlx('Olx', 1) . ' товаров' . '</br>' ?>
                        <?= 'Транпорт - ' . Items::getColOlx('Olx', 2) . ' товаров' . '</br>' ?>
                        <?= 'Недвижимость - ' . Items::getColOlx('Olx', 3) . ' товаров' . '</br>' ?>
                        <?= 'Отдых, спорт - ' . Items::getColOlx('Olx', 4) . ' товаров' . '</br>' ?>
                        <?= 'Бизнес - ' . Items::getColOlx('Olx', 5) . ' услуг' . '</br>' ?>
                        <?= 'Работа - ' . Items::getColOlx('Olx', 6) . ' вакансий' . '</br>' ?>
                    </td>
                    <td><?= Items::getDateUpdate('Olx') ?></td>
                </tr>
                <tr>
                    <td>Rst</td>
                    <td><?= Html::button('Обновить базу rst.ua', ['class' => 'btn btn-primary', 'id' => 'rst-button']) ?></td>
                    <td> <?= Items::getCol('Rst') . ' товаров' ?> </br></td>
                    <td><?= Items::getDateUpdate('Rst') ?></td>
                </tr>
                <tr>
                    <td>Allo</td>
                    <td><?= Html::button('Обновить базу allo.ua', ['class' => 'btn btn-primary', 'id' => 'allo-button']) ?></td>
                    <td><?= Items::getCol('Allo') . ' товаров' ?> </br></td>
                    <td><?= Items::getDateUpdate('Allo') ?></td>
                </tr>
                <tr>
                    <td>Comfy</td>
                    <td><?= Html::button('Обновить базу comfy.ua', ['class' => 'btn btn-primary', 'id' => 'comfy-button']) ?></td>
                    <td><?= Items::getCol('Comfy') . ' товаров' . '</br>' ?></td>
                    <td><?= Items::getDateUpdate('Comfy') ?></td>
                </tr>
                <tr>
                    <td>FoxMart</td>
                    <td><?= Html::button('Обновить базу foxmart.ua', ['class' => 'btn btn-primary', 'id' => 'foxmart-button']) ?></td>
                    <td><?= Items::getCol('FoxMart') . ' товаров' . '</br>' ?></td>
                    <td><?= Items::getDateUpdate('FoxMart') ?></td>
                </tr>
                <tr>
                    <td>Microtron</td>
                    <td><?= Html::button('Обновить базу microtron.ua', ['class' => 'btn btn-primary', 'id' => 'microtron-button']) ?></td>
                    <td><?= Items::getCol('Microtron') . ' товаров' . '</br>' ?></td>
                    <td><?= Items::getDateUpdate('Microtron') ?></td>
                </tr>
                <tr>
                    <td>Rozetka</td>
                    <td><?= Html::button('Обновить базу rozetka.ua', ['class' => 'btn btn-primary', 'id' => 'rozetka-button']) ?></td>
                    <td><?= Items::getCol('Rozetka') . ' товаров' . '</br>' ?></td>
                    <td><?= Items::getDateUpdate('Rozetka') ?></td>
                </tr>
                <tr>
                    <td>AutoRia</td>
                    <td><?= Html::button('Обновить базу auto.ria.com', ['class' => 'btn btn-primary', 'id' => 'auto-ria-button']) ?></td>
                    <td><?= Items::getCol('AutoRia') . ' товаров' . '</br>' ?></td>
                    <td><?= Items::getDateUpdate('AutoRia') ?></td>
                </tr>
                <tr>
                    <td>DomRia</td>
                    <td><?= Html::button('Обновить базу dom.ria.com', ['class' => 'btn btn-primary', 'id' => 'dom-ria-button']) ?></td>
                    <td><?= Items::getCol('DomRia') . ' товаров' . '</br>' ?></td>
                    <td><?= Items::getDateUpdate('DomRia') ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>