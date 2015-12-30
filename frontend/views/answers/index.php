<?php
/* @var $this yii\web\View */
/* @var $news common\models\News */
$this->title = 'Помощь';
?>

<div class="container">
    <h1><?=  $this->title ?></h1>
    <?php foreach($news as $new){ ?>
        <p><?= $new->text ?></p>
        <p><?= $new->answer ?></p>
    <?php } ?>
</div>