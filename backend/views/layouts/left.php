<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $directoryAsset; ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <?= dmstr\widgets\Menu::widget([
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    ['label' => 'Главная', 'icon' => 'fa fa-home', 'url' => ['/']],
                    ['label' => 'База товаров', 'icon' => 'fa fa-list', 'url' => ['/parsing/index']],
                    ['label' => 'Пользователи сайта', 'icon' => 'fa fa-user', 'url' => ['/user/view']],
                    ['label' => 'Поисковые запросы', 'icon' => 'fa fa-search', 'url' => ['/user/searched']],
                    ['label' => 'Тарифные планы', 'icon' => 'fa fa-credit-card', 'url' => ['/plans/index']],
                    ['label' => 'Комментарии', 'icon' => 'fa fa-comments', 'url' => ['/comments/view']],
                    ['label' => 'Новости', 'icon' => 'fa fa-newspaper-o', 'url' => ['/news/view']],
                    ['label' => 'Помощь', 'icon' => 'fa fa-question', 'url' => ['/answers/view']],
                ],
            ]
        ) ?>
    </section>
</aside>
