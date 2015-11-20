<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Parse button admin';
?>

<div class="body-content">
    <?= Html::a('Add to database from parse', Url::to('/parsing/save_olx'), ['class' => 'btn btn-default']) ?>
</div>
