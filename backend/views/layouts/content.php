<?php
use dmstr\widgets\Alert;
?>
<div class="content-wrapper">
    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>
<div class='control-sidebar-bg'></div>