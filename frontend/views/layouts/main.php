<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use ijackua\sharelinks\ShareLinks;
$share = new ShareLinks();
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="/images/icon/logo.ico" class="pull-left" style="margin-top: -15px"/>SISHIK.NET',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
//    $menuItems[] = ['label' => 'Домашняя страница', 'url' => Yii::$app->homeUrl];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Новости', 'url' => ['/news/index']];
        $menuItems[] = ['label' => 'Помощь', 'url' => ['/answers/index']];
//        $menuItems[] = ['label' => 'Сайты партнеры', 'url' => ['/#partenrs']];
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['user/signup']];
        $menuItems[] = ['label' => 'Вход', 'url' => ['user/login']];

    } else {
        $menuItems[] = ['label' => 'Новости', 'url' => ['/news/index']];
        $menuItems[] = ['label' => 'Личный кабинет', 'url' => ['user/profile']];
        $menuItems[] = ['label' => 'Помощь', 'url' => ['/answers/index']];
//        $menuItems[] = ['label' => 'Сайты партнеры', 'url' => ['/#partenrs']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/user/logout'], 'post')
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

</div>
<div id="partenrs"></div>
<footer class="footer">
   <div class="top-footer">
       <div class="container">
           <div class="social-footer">
               <?=
               Html::a('<i class="fa fa-facebook"></i>', $share->shareUrl(ShareLinks::SOCIAL_FACEBOOK),
                   ['title' => 'Share to Facebook']) ?>
               <?=
               Html::a('<i class="fa fa-twitter"></i>', $share->shareUrl(ShareLinks::SOCIAL_TWITTER),
                   ['title' => 'Share to Twitter']) ?>
               <?=
               Html::a('<i class="fa fa-google-plus"></i>', $share->shareUrl(ShareLinks::SOCIAL_GPLUS),
                   ['title' => 'Share to Google Plus']) ?>
               <?=
               Html::a('<i class="fa fa-vk"></i>', $share->shareUrl(ShareLinks::SOCIAL_VKONTAKTE),
                   ['title' => 'Share to Vkontakte']) ?>
            </div>
         </div>

    </div>
    <div class="copyright">
        <div class="container">
            <p>Copyright &copy; <?= date('Y') ?> &middot; Contact</p>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
