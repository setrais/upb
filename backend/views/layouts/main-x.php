<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\nav\NavX;
use kartik\sidenav\SideNav;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-lg-2 logo">LOGO</div>
                <nav class="col-xs-7 col-sm-5 col-lg-7 top-nav">TOP-NAV</nav>
                <div class="col-xs-5 col-sm-4 col-lg-3 social">SOCIAL</div>
            </div>
        </div>
    </header>

    <main class="main" style="margin-top:50px;">
        <div class="container-fluid">
            <div class="row main-hero hidden">
                <div class="col-lg-6 hero">HERO</div>
                <div class="col-lg-3 action">ACTION</div>
                <div class="col-lg-3 visible-lg-block ad">AD</div>
            </div>
            <div class="row main-article">
                <aside class="col-sm-9 col-lg-2 left">    <?php
                    $type = 'default';
                    $heading = '<h3 class="panel-title"><i class="glyphicon glyphicon-cog"></i> Операции</h3>';

                    $item = $action = $this->context->action->id;
                    $controller = Yii::$app->controller->id;

                    echo SideNav::widget([
                        'type' => $type,
                        'encodeLabels' => false,
                        'heading' => $heading,
                        'items' => [
                            // Important: you need to specify url as 'controller/action',
                            // not just as 'controller' even if default action is used.
                            //
                            // NOTE: The variable `$item` is specific to this demo page that determines
                            // which menu item will be activated. You need to accordingly define and pass
                            // such variables to your view object to handle such logic in your application
                            // (to determine the active status).
                            //
                            ['label' => Yii::t('app/main','В Собор'), 'icon' => 'home', 'url' => Url::to(['/site/index', 'type'=>$type]), 'active' => ($item == 'index')],
                            ['label' => Yii::t('app/main','Основные реквезиты'), 'icon' => 'info', 'url' => Url::to(['/site/info', 'type'=>$type]), 'active' => ($item == 'info')],
                            ['label' => Yii::t('app/main','Настройки сайта'), 'icon' => 'setting', 'url' => Url::to(['/site/setting', 'type'=>$type]), 'active' => ($item == 'setting')],
                            ['label' => Yii::t('app/main','Управление контентом'), 'icon' => 'control', 'url' => Url::to(['/site/control', 'type'=>$type]), 'active' => ($item == 'control'),
                                'items'=>[['label' => '<span class="pull-right badge">10</span> '.Yii::t('app/menu','Блоки'), 'url' => Url::to(['/site/blocks', 'type'=>$type]), 'active' => ($item == 'blocks')],
                                          ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Уделы'), 'url' => Url::to(['/site/portion', 'type'=>$type]), 'active' => ($item == 'portion')],
                                          ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Меню'), 'url' => Url::to(['/site/most-popular', 'type'=>$type]), 'active' => ($item == 'pages')],
                                          ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Разделы'), 'url' => Url::to(['/site/section', 'type'=>$type]), 'active' => ($item == 'section')],
                                          ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Страницы'), 'url' => Url::to(['/site/most-popular', 'type'=>$type]), 'active' => ($item == 'pages')],
                                          ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Новости'), 'url' => Url::to(['/site/news', 'type'=>$type]), 'active' => ($item == 'news')],
                                          ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Статьи'), 'url' => Url::to(['/site/articles', 'type'=>$type]), 'active' => ($item == 'articles')],
                                          ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Блоги'), 'url' => Url::to(['/site/blogs', 'type'=>$type]), 'active' => ($item == 'blogs')],
                                          ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Сообщения'), 'url' => Url::to(['/site/messages', 'type'=>$type]), 'active' => ($item == 'messages')],
                            ]],
                            ['label' => Yii::t('app/main','Справочники'), 'icon' => 'directory', 'url' => Url::to(['/site/directory', 'type'=>$type]), 'active' => ($item == 'directory'),
                                'items'=>[['label' => '<span class="pull-right badge">10</span> '.Yii::t('app/menu','Храмы'), 'url' => Url::to(['/site/hrams', 'type'=>$type]), 'active' => ($item == 'cities')],
                                          ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Уделы'), 'url' => Url::to(['/site/portion', 'type'=>$type]), 'active' => ($item == 'portion')],
                                          ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Расписание'), 'url' => Url::to(['/site/raspisanie', 'type'=>$type]), 'active' => ($item == 'raspisanie')],
                                          ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Календарь'), 'url' => Url::to(['/site/calendar', 'type'=>$type]), 'active' => ($item == 'calendar')],
                                          ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Таинства'), 'url' => Url::to(['/site/tainstva', 'type'=>$type]), 'active' => ($item == 'tainstva')],
                                          ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Страны'), 'url' => Url::to(['/site/country', 'type'=>$type]), 'active' => ($item == 'country')],
                                          ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Епархии'), 'url' => Url::to(['/site/section', 'type'=>$type]), 'active' => ($item == 'section')],
                            ]],
                            ['label' => Yii::t('app/main','Настройки сайта'), 'icon' => 'setting', 'url' => Url::to(['/site/setting', 'type'=>$type]), 'active' => ($item == 'setting')],
                            ['label' => Yii::t('app/main','Рассылка'), 'icon' => 'send', 'url' => Url::to(['/site/sends', 'type'=>$type]), 'active' => ($item == 'sends')],
                            ['label' => Yii::t('app/main','Приход'), 'icon' => 'prihod', 'url' => Url::to(['/site/prihod', 'type'=>$type]), 'active' => ($item == 'prihod'),
                             'items' =>[['label' => '<span class="pull-right badge">10</span> '.Yii::t('app/menu','Прихожани трудники'), 'url' => Url::to(['/site/makes', 'type'=>$type]), 'active' => ($item == 'makes')],
                                        ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Алтарь'), 'url' => Url::to(['/site/altar', 'type'=>$type]), 'active' => ($item == 'altar')],
                                        ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Певчие'), 'url' => Url::to(['/site/sounders', 'type'=>$type]), 'active' => ($item == 'sounders')],
                                        ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Охранники'), 'url' => Url::to(['/site/secureters', 'type'=>$type]), 'active' => ($item == 'secureters')],
                                        ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Прочие'), 'url' => Url::to(['/site/others', 'type'=>$type]), 'active' => ($item == 'others')],
                            ]],
                            ['label' => Yii::t('app/main','Отцовский удел'), 'icon' => 'otec', 'url' => Url::to(['/site/otec', 'type'=>$type]), 'active' => ($item == 'otec')],
                            ['label' => Yii::t('app/main','Келии'), 'icon' => 'otec', 'url' => Url::to(['/site/kelii', 'type'=>$type]), 'active' => ($item == 'kelii')],
                            ['label' => Yii::t('app/main','Песнопения'), 'icon' => 'otec', 'url' => Url::to(['/site/pesnopenija', 'type'=>$type]), 'active' => ($item == 'pesnopenija')],
                            ['label' => Yii::t('app/main','Воскресная школа'), 'icon' => 'shckola', 'url' => Url::to(['/site/shckola', 'type'=>$type]), 'active' => ($item == 'shckola')],
                            ['label' => Yii::t('app/main','Иконная лавка'), 'icon' => 'shckola', 'url' => Url::to(['/site/lavka', 'type'=>$type]), 'active' => ($item == 'lavka')],
                            ['label' => Yii::t('app/main','Паломнический отдел'), 'icon' => 'palomnik', 'url' => Url::to(['/site/palomnik', 'type'=>$type]), 'active' => ($item == 'palomnik')],
                            ['label' => Yii::t('app/main','Файлы'), 'icon' => 'otec', 'url' => Url::to(['/site/files', 'type'=>$type]), 'active' => ($item == 'files')],
                            ['label' => Yii::t('app/menu','Библиотека'), 'icon' => 'books', 'items' => [
                                ['label' => '<span class="pull-right badge">10</span> '.Yii::t('app/menu','Новые поступления'), 'url' => Url::to(['/site/new-arrivals', 'type'=>$type]), 'active' => ($item == 'new-arrivals')],
                                ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Наиболее популярное'), 'url' => Url::to(['/site/most-popular', 'type'=>$type]), 'active' => ($item == 'most-popular')],
                                ['label' => '<span class="pull-right badge">5</span> '.Yii::t('app/menu','Лучшее'), 'url' => Url::to(['/site/the-best', 'type'=>$type]), 'active' => ($item == 'the-best')],
                                ['label' => 'Читаемое на сайте', 'icon' => 'cloud', 'items' => [
                                    ['label' => 'Для прихожан', 'url' => Url::to(['/site/for-prihogan', 'type'=>$type]), 'active' => ($item == 'online-1for-prihogan')],
                                    ['label' => 'Для чад', 'url' => Url::to(['/site/for-children', 'type'=>$type]), 'active' => ($item == 'for-prihogan')]
                                ]],
                            ]],
                            /*['label' => '<span class="pull-right badge">3</span> Категории', 'icon' => 'tags', 'items' => [
                                ['label' => 'СтраницыFiction', 'url' => Url::to(['/site/fiction', 'type'=>$type]), 'active' => ($item == 'fiction')],
                                ['label' => 'Historical', 'url' => Url::to(['/site/historical', 'type'=>$type]), 'active' => ($item == 'historical')],
                                ['label' => '<span class="pull-right badge">2</span> Announcements', 'icon' => 'bullhorn', 'items' => [
                                    ['label' => 'Event 1', 'url' => Url::to(['/site/event-1', 'type'=>$type]), 'active' => ($item == 'event-1')],
                                    ['label' => 'Event 2', 'url' => Url::to(['/site/event-2', 'type'=>$type]), 'active' => ($item == 'event-2')]
                                ]],
                            ]],*/
                            ['label' => Yii::t('app/main','Отчетность'), 'icon' => 'otchetnost', 'url' => Url::to(['/site/otchetnost', 'type'=>$type]), 'active' => ($item == 'otchetnost')],
                            ['label' => 'Профиль', 'icon' => 'user', 'url' => Url::to(['/site/profile', 'type'=>$type]), 'active' => ($item == 'profile')],
                            ['label' => 'История', 'icon' => 'history', 'url' => Url::to(['/site/history', 'type'=>$type]), 'active' => ($item == 'history')],
                            ['label' => Yii::t('app/main','Api'), 'icon' => 'api', 'url' => Url::to(['/site/api', 'type'=>$type]), 'active' => ($item == 'api')],
                        ],
                    ]);
                    ?>
                </aside>
                <div class="col-sm-3 hidden-lg ad">AD</div>
                <div class="clearfix hidden-lg"></div>
                <article class="col-lg-8 article">
                    <div class="wrap">
                        <?php
                        NavBar::begin([
                            'brandLabel' => /*'My company'*/ 'Управление сайтом',
                            'brandUrl' => '/'/* Yii::$app->homeUrl*/,
                            'options' => [
                                'class' => 'navbar-inverse navbar-fixed-top',
                            ],
                        ]);
                        $menuItems = [
                            ['label' => 'Администрирование'/*'Home'*/, 'url' => ['/site/index']],
                        ];
                        if (Yii::$app->user->isGuest) {
                            $menuItems[] = ['label' => 'Вход'/*'Login'*/, 'url' => ['/site/login']];
                        } else {
                            $menuItems[] = '<li>'
                                . Html::beginForm(['/site/logout'], 'post')
                                . Html::submitButton(
                                /*'Logout*/ 'Выход (' . Yii::$app->user->identity->username . ')',
                                    ['class' => 'btn btn-link logout']
                                )
                                . Html::endForm()
                                . '</li>';
                        }
                        /*echo NavX::widget([
                            'options' => ['class' => 'navbar-nav navbar-right'],
                            //'options' => ['class' => 'nav nav-pills'],
                            'items' => $menuItems,
                            'encodeLabels' => false
                        ]);*/
                        echo NavX::widget([
                            'options' => ['class' => 'navbar-nav navbar-right'],
                            'items' => [
                                ['label' => 'Пункт 1', 'url' => '#'],
                                ['label' => 'Подменю', 'items' => [
                                    ['label' => 'Пункт 1', 'url' => '#'],
                                    ['label' => 'Другой пункт', 'url' => '#'],
                                    ['label' => 'Что-нибудь еще', 'url' => '#'],
                                ]],
                                ['label' => 'Что-нибудь еще', 'url' => '#'],
                                '<li class="divider"></li>',
                                ['label' => 'Разделительная ссылка', 'url' => '#'],
                            ],
                            'encodeLabels' => false
                        ]);
                        NavBar::end();
                        ?>
                        <div class="container">
                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                'homeLink' => [
                                    'label' => 'Управление',
                                    'url' => Yii::$app->homeUrl,
                                ],
                            ]) ?>
                            <?= Alert::widget() ?>
                            <?= $content ?>
                        </div>
                        <?php /*<div class="content">
                            <div class="container-fluid">
                                <?= $content ?>
                            </div>
                        </div>*/ ?>
                    </div>
                </article>
                <aside class="col-lg-2 right hidden">RIGHT</aside>
            </div>
        </div>
    </main>

    <footer class="footer">
            <?php /*<div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <?= date('Y') ?> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>*/ ?>
            <div class="container" style="color:">
                <p class="copyright pull-left "> &copy; Храм Успение Пресвятой Богородицы <?= date('Y') ?></p>
                <p class="copyright pull-right"><?php /*<a href="http://rtvs.net">Web Studio-RTvs</a>*/?> <?php //= Yii::powered() ?></p>
            </div>
    </footer>

</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
