<?php
/* @var $this yii\web\View */
/* @var $news common\models\News */
$this->title = 'Новости';
?>

<div class="container">
    <h1><?= $this->title ?></h1>
    <?php foreach($news as $new){ ?>
        <h3 style="text-transform: lowercase"><?= $new->title ?></h3>
        <p><?= $new->description ?></p>
    <?php } ?>
</div>