<?php
/* @var $this yii\web\View */
$this->title = 'Поиск';
use yii\helpers\Url;
?>

<div class="jumbotron">
    <h1>Поиск завершен!</h1>

    <p class="lead">Вам прийдет смс на ваш номер <?= Yii::$app->user->identity->phone ?></p>

    <p><a class="btn btn-lg btn-success" href="<?= Url::home() ?>">Искать еще</a></p>
</div>
