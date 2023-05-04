<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use kartik\widgets\DatePicker;
use justinvoelker\tagging\TaggingWidget;
use asu\tagcloud\TagCloud;
//use dongrim\tagcloud\widgets\TagCloud;

//use yii\jui\DatePicker;
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
<header class="header" style="position: fixed;
    right: 0;
    left: 0;
    z-index: 9999;
    margin-top: -30px;
    /*padding-bottom: 10px;*/
    /* background: blue; */
    background: #fff;">
    <div class="container-fluid" <?php /*style=" <?php /*padding-top: 17px; padding-top: 80px; padding-bottom: 20px;"*/ ?>>
        <div class="row lh-normal">
            <div class="col-xs-2 col-sm-2 col-lg-2 logo text-shadow-grey no-underline ff-pt-serif bg-angels-border-l" style="text-align:center; padding-top: 80px; padding-bottom: 20px;    height: 100pt;">LOGO</div>
            <nav class="col-xs-8 col-sm-8 col-lg-8 top-nav  bg-angels-border-c" <?php /*style="padding-top: 2px;"*/ ?> >
                <div class="icons-cloud text-center ff-pt-serif bg-angels" style="padding-top: 80px; padding-bottom: 20px;    height: 100pt;">
                    <span><?php echo Html::a('Библия', '#', ['class' => 'profile-link text-shadow-grey no-underline']);?></span><br/>
                    <span><?php echo Html::a('Православие', '#', ['class' => 'profile-link text-shadow-grey no-underline']);?></span>
                    <span><?php echo Html::a('Настоятель', '#', ['class' => 'profile-link text-shadow-grey no-underline']);?></span>
                </div>
            </nav>
            <div class="col-xs-2 col-sm-2 col-lg-2 social bg-angels-border-r" style="padding-top: 80px; padding-bottom: 20px;    height: 100pt;">
                <div class="menu-icons text-right icxp-m-l-50" style="text-align: center;margin-left: -18px;">
                        <span><?php echo Html::a('<i class="fa fa-map" aria-hidden="true"></i>', '/site/atlas/', ['class' => 'profile-link text-shadow-grey c-555', 'alt'=>'Атлас']);?></span>
                        <span><?php echo Html::a('<i class="fa fa-sitemap" aria-hidden="true"></i>', '/site/map/', ['class' => 'profile-link text-shadow-grey c-555', 'alt'=>'Карта сайта']);?></span>
                        <span><?php echo Html::a('<i class="fa fa-rss" aria-hidden="true"></i>', '/site/rss/', ['class' => 'profile-link text-shadow-grey c-555', 'alt'=>'Rss']);?></span>
                        <span><?php echo Html::a('<i class="fa fa-send-o" aria-hidden="true"></i>', '/site/rss/', ['class' => 'profile-link text-shadow-grey c-555','alt'=>'Обратная связь']);?></span>
                        <span><?php echo Html::a('<i class="fa fa-arrows" aria-hidden="true"></i>', '/site/arrow/', ['class' => 'profile-link text-shadow-grey c-555', 'alt'=>'Маштаб']);?></span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- MAIN -->
<main id="upb" class="main">
    <div class="container-fluid" style="<?php /*padding-top: 72px;*/ ?>padding-top: 152px;">
        <div class="row main-hero">
            <div class="col-sm-9 col-lg-2 hero">&nbsp;
                <form class="bd-search d-flex align-items-center">
                    <span class="algolia-autocomplete algolia-autocomplete-left" style="position: relative; direction: ltr;">
                        <input type="search" class="form-control ds-input" id="search-input" placeholder="Поиск по собору..." autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" dir="auto" style="position: relative; vertical-align: top;">
                        <pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; font-size: 16px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: normal; text-indent: 0px; text-rendering: auto; text-transform: none;">button</pre>
                        <span class="ds-dropdown-menu ds-with-1" role="listbox" id="algolia-autocomplete-listbox-0" style="position: absolute; top: 100%; z-index: 100; left: 0px; right: auto; display: none;">
                            <div class="ds-dataset-1"></div>
                        </span>
                    </span>
                </form>
            </div>
            <div class="col-lg-8 action">
                <div class="menu link icxp-fs-10t m-t16">
                    <span><?php echo Html::a('Харьковский епархиальный ресурс', 'http://www.eparchia.kharkov.ua/', ['class' => 'profile-link']);?></span>
                    <span><?php echo Html::a('Харьковская Духовная Семинария', 'http://seminary.kharkov.ua/', ['class' => 'profile-link']);?></span>
                    <span><?php echo Html::a('Україна Православна', 'http://www.pravoslavye.org.ua/', ['class' => 'profile-link']);?></span>
                    <span><?php echo Html::a('Православие.ру', 'http://www.pravoslavie.ru/', ['class' => 'profile-link']);?></span>
                    <span><?php echo Html::a('Богослов.ру', 'http://www.bogoslov.ru/', ['class' => 'profile-link']);?></span>
                </div>
            </div>
            <div class="col-lg-2 visible-lg-block ad">
                <div class="row row-flex">
                    <div class="col-md-12 col-sm-6 col-xs-12">
                        <div class="content colour-1">
                            <div class="border border-secondary rounded p-1 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <blockquote class="blockquote-reverse m-0">
                                    <p class="m-b0 right">И было слово</p>
                                    <footer>Слово Настоятеля <cite title="Source Title">Прт.Виталия</cite></footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row main-article pos-r">
            <aside class="<?php /*col-sm-9*/?> col-sm-12 col-lg-2 left">
                <div class="row row-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content colour-1">
                            <div class="header-h1">
                                <h1>Слова Предстоятеля</h1>
                            </div>
                            <div class="border border-secondary rounded p-1 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row center-block m-t10" >
                                    <img src="/img/Богоявлення-32.jpg" alt="Богоявление" class="img-thumbnail">
                                    <?php /* <blockquote> */?>
                                        <p class="text-center bg-grey footer-block ">
                                            <cite title="Бог екзаменує ">Бог екзаменує нас на вірність Істині</cite>
                                        </p>
                                    <?php /*</blockquote> > */?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content colour-1">
                            <div class="header-h1">
                                <h1>Календарь</h1>
                            </div>
                            <div class="border border-secondary rounded p-1 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <p>
                                <?php echo DatePicker::widget([
                                    'name' => 'dp',
                                    'value' => date('d-M-Y'),
                                    'type' => DatePicker::TYPE_INLINE,
                                    'language' => 'ru',
                                    'pluginOptions' => [
                                        'format' => 'dd-M-yyyy',
                                        //'multidate' => true,
                                        'todayHighlight' => true,
                                        'startDate' => '01-01-2019',
                                        'endDate' => '31-12-2019',
                                        'weekStart'=>0,
                                        'daysOfWeekDisabled'=>[0,6],
                                        'todayBtn'=>true,
                                        /*'beforeShowDay' => new JsExpression($JsBeforeDay),
                                        'beforeShowMonth' => new JsExpression($JsBeforeMonth),
                                        'beforeShowYear' => new JsExpression($JsBeforeYear),*/
                                        'toggleActive'=>true,
                                    ],
                                    'pluginEvents' => [
                                        /*"show" => "function(e) {  alert('# `e` here contains the extra attributes ');}",
                                        "hide" => "function(e) {  alert('# `e` here contains the extra attributes ');}",
                                        "clearDate" => "function(e) { alert('# `e` here contains the extra attributes ');}",*/
                                        "changeDate" => "function(date) { location.href='/site/page'+date.getFullYear();/*alert('# `e` here contains the extra attributes ');*/}",
                                        "changeYear" => "function(e) { alert('# `e` here contains the extra attributes ');}",
                                        "changeMonth" => "function(e) { alert('# `e` here contains the extra attributes ');}",
                                    ],
                                    'options' => [
                                        // you can hide the input by setting the following
                                        // 'style' => 'display:none'
                                    ]
                                ]); ?>
                                <?php /* echo DatePicker::widget([
                                            'name' => 'dp',
                                            'value' => date('d-M-Y'),
                                            'clientEvents' => [
                                                   'change' => 'function () { alert(\'event "change" occured.\'); }'
                                            ],
                                            'inline'=>true,
                                            //'type' => DatePicker::TYPE_INLINE,
                                            'language' => 'ru',
                                            /*'pluginOptions' => [
                                                'format' => 'dd-M-yyyy',
                                                //'multidate' => true,
                                                'todayHighlight' => true
                                            ],
                                            'options' => [
                                                // you can hide the input by setting the following
                                                // 'style' => 'display:none'
                                            ]
                                ]);*/ ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content colour-1">
                            <div class="header-h1">
                                <h1>Мы среди Вас</h1>
                            </div>
                            <div class="border border-secondary rounded p-1 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                <div class="row center-block m-t10" >
                                    <?php /*<img src="/img/malyy-pors-k-696x522-300x225.jpg" alt="Изображение иконы" class="img-thumbnail">*/?>
                                    <img src="/img/IMG-b1d66d835c48796a49f8a62dd49a58bd-V.jpg" alt="Наше изображение" class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content colour-1">
                            <div class="header-h1">
                               <h1>Расписание Богослужений</h1>
                            </div>
                            <div class="border border-secondary rounded p-1 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table class="table table-striped">
                                   <thead>
                                       <tr>
                                            <th>Неделя месяца</th>
                                            <th>Период</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <tr>
                                           <td>1 неделя</td>
                                           <td><a href="#">01-07</a></td>
                                       </tr>
                                       <tr>
                                           <td>2 неделя</td>
                                           <td><a href="#">08-14</a></td>
                                       </tr>
                                       <tr>
                                           <td>3 неделя</td>
                                           <td><a href="#">14-21</a></td>
                                       </tr>
                                       <tr>
                                           <td>4 неделя</td>
                                           <td><a href="#">22-28</a></td>
                                       </tr>
                                       <tr>
                                           <td>5 неделя</td>
                                           <td><a href="#">29-04</a></td>
                                       </tr>
                                   </tbody>
                                   <tfoot>
                                       <tr>
                                          <th colspan="2"></th>
                                       </tr>
                                   </tfoot>
                                </table>
                               <?php /*<div class="row ">
                                    <div class="col-xs-12 col-sm-6 col-md-8">Неделя месяца</div>
                                    <div class="col-xs-6 col-md-4">Период</div>
                                </div>
                               <div class="row">
                                   <div class="col-xs-12 col-sm-6 col-md-8">1 неделя</div>
                                   <div class="col-xs-6 col-md-4">01-07</div>
                               </div>*/ ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content colour-1">
                            <div class="header-h1">
                                <h1>Икона дня</h1>
                            </div>
                            <div class="border border-secondary rounded p-1 col-md-12 text-center">
                                <div class="row center-block m-t10" >
                                    <img src="/img/icona-day.jpg" alt="Изображение иконы" width="100%" class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content colour-1">
                            <div class="header-h1">
                                <h1>Православные журналы Украины</h1>
                            </div>
                            <div class="border border-secondary rounded p-1 col-md-12">
                                <table class="table table-striped">
                                    <thead></thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="http://www.pravzhurnal.ru/">Православный интернет-журнал «Преображение»</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="http://www.foma.in.ua/">Православный журнал ФОМА в Украине</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="www.blagogon.ru">Православный журнал Благодатный огонь</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="https://foma.ru/">Православный журнал ФОМА</a></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="2"></th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <?php /*<div class="row ">
                                    <div class="col-xs-12 col-sm-6 col-md-8">Неделя месяца</div>
                                    <div class="col-xs-6 col-md-4">Период</div>
                                </div>
                               <div class="row">
                                   <div class="col-xs-12 col-sm-6 col-md-8">1 неделя</div>
                                   <div class="col-xs-6 col-md-4">01-07</div>
                               </div>*/ ?>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <div class="col-sm-3 hidden-lg ad">AD</div>
            <div class="clearfix hidden-lg"></div>
            <article class="col-lg-8 article pos-r">
                <div class="wrap">
                    <?php NavBar::begin([
                        'brandLabel' => '<span style="text-align: center;font-size:11pt;color:#f0f0f0;vertical-align: middle;">Собор Успения Пресвятой Богородицы</span>',
                        'brandUrl' => Yii::$app->homeUrl,
                        'brandOptions' => [ 'class'=>"navbar-brand", 'style'=>'position: absolute; min-width: 210px; text-align: left;'],
                        /*'containerOptions' => [
                            'class' =>  'collapse navbar-collapse col-lg-10',
                        ],*/
                        /*'innerContainerOptions'=>[ 'class' => 'container row row-flesh' ],*/
                        /*'navbarContainerOptions' => [ 'class'=>'navbar-header col-lg-2'],*/
                        'options' => [
                            'class' => 'navbar-inverse navbar-fixed-top',
                            /*'class' => 'navbar-default navbar-static-top',*/
                            'style' => 'margin-top: 132px;',
                            /*'data-spy'=>"affix",
                            'data-offset-top'=>"90"*/
                        ],
                    ]);
                    //echo "<pre>".var_dump(Yii::$app->controller->action->id);
                    $menuItems[] = ['label' => Yii::t('app/menu','В Собор'), 'url' => ['/site/index']];
                    $menuItems[] = ['label' => Yii::t('app/menu','Службы'), 'url' => ['/site/'.Yii::t('app/tr','sluzhby')]];
                    $menuItems[] = ['label' => Yii::t('app/menu','Таинства'), 'url' => ['/site/'.Yii::t('app/tr','tainstva')],
                                        'items' =>[
                                                    ['label' => Yii::t('app/menu','Крещение'), 'url' => ['/site/tainstva/kreshcheniye']],
                                                    ['label' => Yii::t('app/menu','Миропомазание'), 'url' => ['/site/tainstva/miropomazaniye']],
                                                    ['label' => Yii::t('app/menu','Причастие(Евхористия)'), 'url' => ['/site/tainstva/prichastiye']],
                                                    ['label' => Yii::t('app/menu','Покояние(Исповедь)'), 'url' => ['/site/tainstva/ispoved']],
                                                    ['label' => Yii::t('app/menu','Елеосвящение(Соборование)'), 'url' => ['/site/tainstva/maslosoborovaniye']],
                                                    ['label' => Yii::t('app/menu','Венчание(Таинство Брака)'), 'url' => ['/site/tainstva/venchanie']],
                                                    ['label' => Yii::t('app/menu','Таинство священства'), 'url' => ['/site/tainstva/svyashchenstva']],
                                                  ]
                    ];
                    $menuItems[] = ['label' => Yii::t('app/menu','Для Вас'), 'url' => ['/site/'.Yii::t('app/tr','for-you')],
                        'items' => [
                            ['label' => Yii::t('app/menu','Воскрестная школа'), 'url' => ['/site/'.Yii::t('app/tr','voskresnaya_shkola')]],
                            ['label' => Yii::t('app/menu','Приходская библиотека'),
                             'url' => 'http://www.biblioteka.izdatsovet.ru/'/*['/site/'.Yii::t('app/tr','biblioteka')}*/,
                             'active' =>  ( Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'biblioteka' ),
                             'icon' => 'fa fa-dashboard',
                             'linkOptions' => ['target' => '_blank']  ,
                             'template'=> '<a href="{url}" target="_blank">{icon}{label}</a>'
                            ],
                             //'visible' =>  ( Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'biblioteka' )],
                             //'options' => array ( 'class' => ( Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'biblioteka' ) ? 'active' : '')],
                            ['label' => Yii::t('app/menu','Иконная Лавка'), 'url' => ['/site/'.Yii::t('app/tr','icon_lavka')]]
                        ]
                    ];
                    //$menuItems[] = ['label' => Yii::t('app/menu','Воскрестная школа'), 'url' => ['/site/'.Yii::t('app/tr','voskresnaya_shkola')], 'options'=>['class'=>'hidden-lg']];
                    $menuItems[] = ['label' => Yii::t('app/menu','Новости Прихода'), 'url' => ['/site/novosti/prixoda']];
                    /*$menuItems[] = ['label' => Yii::t('app/menu','Новости'), 'url' => ['/site/'.Yii::t('app/tr','novosti')],
                                    'items' => [
                                        ['label' => Yii::t('app/menu','Новости Мира'), 'url' => ['/site/novosti/mira']],
                                        ['label' => Yii::t('app/menu','Новости Украины'), 'url' => ['/site/novosti/ukraine']],
                                        ['label' => Yii::t('app/menu','Новости России'), 'url' => ['/site/novosti/russii']],
                                        ['label' => Yii::t('app/menu','Новости Епархии'), 'url' => ['/site/novosti/yeparkhii']],
                                        ['label' => Yii::t('app/menu','Новости Прихода'), 'url' => ['/site/novosti/prixoda']],
                                        ['label' => Yii::t('app/menu','Топ новости'), 'url' => ['/site/novosti/top-novosti']],
                                    ]
                    ];*/
                    $menuItems[] = ['label' => 'Статьи', 'url' => ['/site/'.Yii::t('app/tr','statti')],
                                    'items' => [
                                            ['label' => Yii::t('app/menu','Авторские статьи'), 'url' => ['/site/statti/avtorskie-statti']],
                                            ['label' => Yii::t('app/menu','Православный взгляд'), 'url' => ['/site/statti/pravoslavnoi/vzlad']],
                                            ['label' => Yii::t('app/menu','Межконфесные отношения'), 'url' => ['/site/statti/megkonfesnie-otnoshenia']],
                                            ['label' => Yii::t('app/menu','Расколы'), 'url' => ['/site/statti/raskoli']],
                                            ['label' => Yii::t('app/menu','Другое'), 'url' => ['/site/statti/drugoe']],
                                    ]
                    ];
                    //$menuItems[] = ['label' => 'Библиотека', 'url' => ['/site/'.Yii::t('app/tr','biblioteka')]];
                    //$menuItems[] = ['label' => 'Иконная Лавка', 'url' => ['/site/'.Yii::t('app/tr','icon_lavka')]];

                    if ( Yii::$app->user->isGuest ) {
                        /*$menuItems[] = ['label' => 'О Соборе', 'url' => ['/site/about']];*/
                        $menuItems[] = ['label' => /*'<span class="glyphicon glyphicon-envelope"></span>*/'Контакты', 'url' => ['/site/'.Yii::t('app/tr','contact')]];
                        $menuItems[] = ['label' => 'Гостевая книга', 'url' => ['/site/'.Yii::t('app/tr','guest_book')], 'options' => ['class'=>'hidden-lg']];
                        //$menuItems[] = ['label' => 'Паломничество', 'url' => ['/site/'.Yii::t('app/tr','palomnichestvo')], 'options' => ['class'=>'hidden-lg']];
                        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/'.Yii::t('app/tr','signup')]];
                        $menuItems[] = ['label' => 'Вход', 'url' => ['/site/'.Yii::t('app/tr','login')]];
                    } else {
                        $menuItems[] = ['label' => 'Приходской кабинет', 'url' => ['/site/personal'.Yii::t('app/tr','personal')]];
                        $menuItems[] = ['label' => 'История прихожанина', 'url' => ['/site/transactions'.Yii::t('app/tr','history')]];
                        $menuItems[] = ['label' => 'Храмы', 'url' => ['/site/'.Yii::t('app/tr','hrams')]];
                        $menuItems[] = '<li>'
                            . Html::beginForm(['/site/'.Yii::t('app/tr','logout')], 'post')
                            . Html::submitButton(
                                Yii::t('app/menu','Выход').' (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                            . '</li>';
                    }
                    $menuItems[] = '<button type="button" id="view-all-menu" style="position: absolute;" class="btn btn-link glyphicon glyphicon-menu-down navbar-btn"></button>';
                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav navbar-right'],
                        'items' => $menuItems,
                        'encodeLabels' => false,
                    ]);
                    NavBar::end();

                    $script = <<< JS
                                $('#view-all-menu').click( function(){ // задаем функцию при нажатиии на элемент с классом slide-toggle	      
                                    var menu = $('#w2');
                                    var attr = $('#w2').attr('style');
                                    if ( menu.is('[style]') ) {
                                    // if ( typeof attr !== typeof undefined && attr !== false ) {    
                                        menu.removeAttr("style");
                                    } else {
                                        menu.css({"max-height":"48px","overflow": "hidden"});
                                    }                    
	                            });
                                $('#w2').css({"max-height":"48px","overflow": "hidden"});                                
                                //$('#w2').on('mouseover', function(){ $(this).removeAttr("style") });
                                $('#w2').on('mouseenter', function(){ $(this).removeAttr("style") });
                                //$('#w2').on('mouseout', function(){ $(this).css({"max-height":"48px","overflow": "hidden"}) });
                                $('#w2').on('mouseleave', function(){ $(this).css({"max-height":"48px","overflow": "hidden"}) });    
                                
JS;
                    //маркер конца строки, обязательно сразу, без пробелов и табуляции
                    $this->registerJs($script, yii\web\View::POS_READY);
                    ?>
                    <div class="line header">
                        <div class="row">
                            <center class="col-lg-12"><marquee class="col-lg-12" onmouseover="this.stop()" onmouseout="this.start()" behavior="scroll" bgcolor="#ffffff" scrollamount="10" >Сегодня в Соборе</marquee></center>
                        </div>
                    </div>
                    <br/>
                    <?php
                    ?>

                    <div class="container">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'homeLink' => [
                                'label' => 'Главная',
                                'url' => Yii::$app->homeUrl,
                            ],
                        ]) ?>
                        <?php //=@Test: Yii::$app->session->setFlash('error', 'This is the message');?>
                        <?= Alert::widget() ?>
                        <?= $content ?>
                    </div>
                    <br/>
                    <div class="line fotter">
                        <div class="row">
                            <center class="col-lg-12"><marquee class="col-lg-12" onmouseover="this.stop()" onmouseout="this.start()" behavior="scroll" bgcolor="#ffffff" scrollamount="10" >Собору требуется</marquee></center>
                        </div>
                    </div>
                    <br/>
                </div>
            </article>
            <aside class="col-lg-2 right">
                <div class="row row-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content colour-1">
                            <div class="header-h1">
                                <h1>Новости Киевской Метрополии</h1>
                            </div>
                            <div class="border border-secondary rounded p-1 col-md-12">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th class="col-lg-2">Дата</th>
                                        <th class="col-lg-10">Новость</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="#">01.01.2009</a></td>
                                        <td><p>1 новость</p></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">01.02.2009</a></td>
                                        <td><p>2 новость</p></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">01.04.2009</a></td>
                                        <td><p>3 новость</p></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">01.01.2009</a></td>
                                        <td><p>4 новость</p></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">01.01.2009</a></td>
                                        <td><p>5 новость</p></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">01.01.2009</a></td>
                                        <td><p>6 новость</p></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">01.01.2009</a></td>
                                        <td><p>7 новость</p></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">01.01.2009</a></td>
                                        <td><p>8 новость</p></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="2"></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content colour-1">
                            <div class="header-h1">
                                <h1>Храмы Слобожанщины</h1>
                            </div>
                            <div class="border border-secondary rounded p-1 col-md-12 text-center">
                                <div class="row center-block m-t10" >
                                    <?php /* $tags = [ 'Кафедральный собор святого благоверного великого князя Александра Невского'=>strlen('Кафедральный собор святого благоверного великого князя Александра Невского')/3,
                                                    'Официальный сервер УПЦ'=>2,
                                                    'Официальный сервер УПЦ'=>1];
                                    ?>
                                    <?php echo TaggingWidget::widget([
                                        // TaggingQuery results
                                        'items' => $tags,
                                        // smallest tag size (default: 14)
                                        'smallest' => '14',
                                        // largest tag size (default: 22)
                                        'largest' => '22',
                                        // unit for tag sizes (default: px)
                                        'unit' => 'px',
                                        // display format of 'cloud', 'ul', or 'ol' (default: cloud)
                                        'format' => 'cloud',
                                        // url for links (omit for no link)
                                        'url' => ['post/index'],
                                        // parameter to be appended to url with tag
                                        'urlParam' => 'tag',
                                        // options applied to the list
                                        //'ulOptions' => ['style' => 'text-align:justify'],
                                        // options applied to the list item
                                        'liOptions' => [],
                                        // options applied to the link (if present)
                                        'linkOptions' => [],
                                    ]);*/

                                    echo TagCloud::widget([

                                        'beginColor' => '026990', //'00089A',
                                        'endColor' => '40BEEE', // 'A3AEFF',
                                        'minFontSize' => 8,
                                        'maxFontSize' => 15,
                                        'displayWeight' => false,
                                        'tags' => [
                                            "Свято-Воскресенский храм" => ['weight' => 3, 'url' => 'http://zazimye.narod.ru'],
                                            //"Свято-Кириловская обитель" => ['weight' => 3, 'url' => 'http://www.cyril7.narod.ru'],
                                            //"Свято-Троицкий собор" => ['weight' => 8, 'url' => 'http://www.troickysobor.kiev.ua'],
                                            //"Xрам во имя иконы Божьей Матери Державной" => ['weight' => 1, 'url' => 'http://www.derjava.org.ua'],
                                            "Свято-Пантелеимоновский Храм" => ['weight' => 4, 'url' => 'http://panteleimon.info'],
                                            //"Свято-Троицкий храм" => ['weight' => 7, 'url' => 'http://nashhram1.narod.ru'],
                                            //"Собор архангела Гавриила" => ['weight' => 5, 'url' => 'http://www.sobor-gavriila.org'],
                                            //"Церковь преподобного Сергия Радонежского" => ['weight' => 2, 'url' => 'http://www.sergeevka.odessa.ua/church/church.html'],
                                            //"Храм Спаса" => ['weight' => 10, 'url' => 'http://vicdere.chat.ru'],
                                            //"Храм бессребреников Космы и Дамиана Римских" => ['weight' => 1, 'url' => 'http://kosma.kiev.ua'],
                                            "Храм Святой Ольги" => ['weight' => 10, 'url' => 'http://hram.com.ua/'],
                                            "Храм во имя святителя Луки" => ['weight' => 5, 'url' => 'http://ispovednik.narod.ru'],
                                            "Храм святого равноапостольного князя Владимира" => ['weight' => 1, 'url' => 'http://vladimir.orthodoxy.ru/'],
                                            "Українська Православна Церква" => ['weight' => 8, 'url' => 'http://church.ua/'],
                                            "Храм св. Георгия, Харьковская епархия" => ['weight' => 2, 'url' => 'http://www.stgeorge-kharkov.org'],
                                            "Храм св. прп. Агапита Печерского" => ['weight' => 3, 'url' => 'www.mapetrus.narod.ru/church.html'],
                                            "Храм свт. Николая архиеп. Мир Ликийских" => ['weight' => 2, 'url' => 'www.apostolus.narod.ru'],
                                        ],
                                        'options' => ['style' => 'word-wrap: break-word;']
                                    ]);

                                    // Default Yii: $this->widget('TagCloud', array('limit' => 50));
                                    // echo TagCloud::widget();
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-t10">
                        <div class="content colour-1">
                            <div class="header-h1">
                                <h1>Православные журналы Мира</h1>
                            </div>
                            <div class="border border-secondary rounded p-1 col-md-12">
                                <table class="table table-striped">
                                    <thead></thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="http://www.pravzhurnal.ru/">Православный интернет-журнал «Преображение»</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="http://www.foma.in.ua/">Православный журнал ФОМА в Украине</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="www.blagogon.ru">Православный журнал Благодатный огонь</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="https://foma.ru/">Православный журнал ФОМА</a></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="2"></th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <?php /*<div class="row ">
                                    <div class="col-xs-12 col-sm-6 col-md-8">Неделя месяца</div>
                                    <div class="col-xs-6 col-md-4">Период</div>
                                </div>
                               <div class="row">
                                   <div class="col-xs-12 col-sm-6 col-md-8">1 неделя</div>
                                   <div class="col-xs-6 col-md-4">01-07</div>
                               </div>*/ ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content colour-1">
                            <div class="header-h1">
                                <h1>Видео тека - Всемирные Соборы</h1>
                            </div>
                            <div class="border border-secondary rounded p-1 col-md-12 text-center">
                                <div class="row center-block m-t10" >
                                    <?php /*<iframe width="100%" height="auto" src="http://www.youtube.com/embed/KmIzf9wDuZs?rel=0" frameborder="0" allowfullscreen></iframe>*/?>
                                    <?php /*<iframe width="100%" height="auto" src="https://www.youtube.com/embed/TDWiUyJXw6E" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>*/?>
                                    <iframe width="100%" height="auto" src="https://www.youtube.com/embed/o_xnEXx2Rbc" frameborder="0" allowfullscreen></iframe>
                                    <?php /*<img src="/img/malyy-pors-k-696x522-300x225.jpg" alt="Изображение иконы" class="img-thumbnail">*/ ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-t10">
                        <div class="content colour-1">
                            <div class="header-h1">
                                <h1>Православные Харьков</h1>
                            </div>
                            <div class="border border-secondary rounded p-1 col-md-12">
                                <table class="table table-striped">
                                    <thead></thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="http://www.pravzhurnal.ru/">Православный интернет-журнал «Преображение»</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="http://www.foma.in.ua/">Православный журнал ФОМА в Украине</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="www.blagogon.ru">Православный журнал Благодатный огонь</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="https://foma.ru/">Православный журнал ФОМА</a></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="2"></th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <?php /*<div class="row ">
                                    <div class="col-xs-12 col-sm-6 col-md-8">Неделя месяца</div>
                                    <div class="col-xs-6 col-md-4">Период</div>
                                </div>
                               <div class="row">
                                   <div class="col-xs-12 col-sm-6 col-md-8">1 неделя</div>
                                   <div class="col-xs-6 col-md-4">01-07</div>
                               </div>*/ ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content colour-1">
                            <div class="header-h1">
                                <h1>Союз Православных журналистов</h1>
                            </div>
                            <div class="border border-secondary rounded p-1 col-md-12 text-center">
                                <div class="row center-block m-t10" >
                                    <img src="/img/malyy-pors-k-696x522-300x225.jpg" alt="Изображение иконы" class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</main>
<!-- FOOTER -->
<footer class="footer icxp-fs-10t icxp-p-t10 icxp-h-auto">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="pull-left icxp-m-b10" style="width:90%">
                        <ul id="menu-bottom-link" class="list-group list-unstyled">
                            <li id="menu-item-62536" class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5" >
                                <a title="О нас" href="https://foma.ru/o-nas">О нас</a>
                            </li>
                            <li id="menu-item-62522" class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5" >
                                <a title="Реклама" href="https://foma.ru/reklama">Реклама</a>
                            </li>
                            <li id="menu-item-62537" class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5" >
                                <a title="Магазин" href="http://lavka.foma.ru/">Магазин</a>
                            </li>
                            <li id="menu-item-65640" class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5" >
                                <a title="Подписка" href="https://foma.ru/subscriptions">Подписка</a>
                            </li>
                            <li id="menu-item-62538" class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5" >
                                <a title="Наши партнеры" href="https://foma.ru/nashi-partneryi">Наши партнеры</a>
                            </li>
                            <li id="menu-item-62552" class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5"  >
                                <a title="Авторы" href="/authors">Авторы</a>
                            </li>
                            <li id="menu-item-62539" class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5" >
                                <a title="Правила перепечатки материалов" href="/pravila-perepechatki-materialov">Правила перепечатки материалов</a>
                            </li>
                            <li id="menu-item-93556" class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5" >
                                <a title="Вакансии" href="http://foma.ru/vakansii-fomyi">Вакансии</a>
                            </li>
                            <li id="menu-item-182772" class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5" >
                                <a title="Контакты" href="https://foma.ru/o-nas#contacts">Контакты</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3"></div>
                <div class="col-sm-4">
                    <div class="pull-right" >
                        <ul class="social list-unstyled"><label class="fl p-r8">Мы в: </label>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-telegram" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-telegram"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-adn" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-adn"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-bitbucket" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-bitbucket"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-dropbox" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-dropbox"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-facebook" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-flickr" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-flickr"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-foursquare" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-foursquare"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-github" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-github"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-google" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-google"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-instagram" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-linkedin" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-linkedin"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-microsoft" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-microsoft"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-odnoklassniki" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-odnoklassniki"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-openid" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-openid"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-pinterest" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-pinterest"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-reddit" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-reddit"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-soundcloud" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-soundcloud"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-tumblr" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-tumblr"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-twitter" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-vimeo" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-vimeo-square"></i></a>
                            </li>
                            <?php /*<li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-vk" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-vk"></i></a>
                            </li>
                            <li class="icxp-menu-link-left icxp-menu-link icxp-menu-item icxp-menu-item-iblock icxp-menu-object-page icxp-p-r5 icxp-p-b3">
                                <a class="btn btn-social-icon btn-xs btn-yahoo" onclick="_gaq.push(['_trackEvent', 'btn-social-icon', 'click', 'btn-xs']);"><i class="fa fa-yahoo"></i></a>
                            </li>*/?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="menu link">
                    <div class="row row-flex m-b18 <?php /*m-b94 p-t14*/?> pos-r">
                        <div class="pos-a pos-flower-l-lg pos-flower-l-md pos-flower-l-sm pos-flower-l-sx pos-flower-l-sz pos-flower-l-sf" ><img src="/img/icons/upb-floower.png" height="250"></div>
                        <div class="pos-a pos-flower-r-lg pos-flower-r-md pos-flower-r-sm pos-flower-r-sx pos-flower-r-sz pos-flower-r-sf" ><img src="/img/icons/upb-floower.png" height="250"></div>
                        <div class="col-lg-5 <?php /*col-md-5 col-sm-5 col-sx-5*/?> text-info">
                            <div class="container-fluid push-left">
                                   <div class="row row-flex <?/*m-r40*/?>">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3 fl">
                                        <div class="content colour-1">
                                            <?php /*<h5>Первая колонка</h5>*/ ?>
                                            <p class="h5">
                                            <ul class="list-unstyled text-left">
                                                <li><?php echo Html::a('О проекте', ['/page/photos/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Предстоятель', ['/page/pecnopenie/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 1', ['/page/link1/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 2', ['/page/link2/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 3', ['/page/link3/'], ['class' => 'profile-link text-info']);?></li>
                                            </ul>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3 fl">
                                        <div class="content colour-1">
                                            <?php /*<h5>Первая колонка</h5>*/ ?>
                                            <p class="h5">
                                            <ul class="list-unstyled text-left">
                                                <li><?php echo Html::a('О проекте', ['/page/photos/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Предстоятель', ['/page/pecnopenie/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 1', ['/page/link1/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 2', ['/page/link2/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 3', ['/page/link3/'], ['class' => 'profile-link text-info']);?></li>
                                            </ul>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3 fl">
                                        <div class="content colour-1">
                                            <?php /*<h5>Первая колонка</h5>*/ ?>
                                            <p class="h5">
                                            <ul class="list-unstyled text-left">
                                                <li><?php echo Html::a('Вера', ['/page/vera/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Дети', ['/page/deti/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Культура', ['/page/kultura/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('История', ['/page/history/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Рубрики', ['/page/rubriki/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Архив', ['/page/arxiv/'], ['class' => 'profile-link text-info']);?></li>
                                            </ul>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3 fl">
                                        <div class="content colour-1">
                                            <?php /*<h5>Первая колонка</h5>*/ ?>
                                            <p class="h5">
                                            <ul class="list-unstyled text-left">
                                                <li><?php echo Html::a('Вера', ['/page/vera/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Дети', ['/page/deti/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Культура', ['/page/kultura/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('История', ['/page/history/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Рубрики', ['/page/rubriki/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Архив', ['/page/arxiv/'], ['class' => 'profile-link text-info']);?></li>
                                            </ul>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php /*
                                    <li><?php echo Html::a('О проекте', ['/page/photos/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Предстоятель', ['/page/pecnopenie/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Ccылка 1', ['/page/link1/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Ccылка 2', ['/page/link2/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Ccылка 3', ['/page/link3/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Вера', ['/page/vera/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Дети', ['/page/deti/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Культура', ['/page/kultura/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('История', ['/page/history/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Рубрики', ['/page/rubriki/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Архив', ['/page/arxiv/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('О проекте', ['/page/photos/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Предстоятель', ['/page/pecnopenie/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Ccылка 1', ['/page/link1/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Ccылка 2', ['/page/link2/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Ccылка 3', ['/page/link3/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Вера', ['/page/vera/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Дети', ['/page/deti/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Культура', ['/page/kultura/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('История', ['/page/history/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Рубрики', ['/page/rubriki/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Архив', ['/page/arxiv/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('О проекте', ['/page/photos/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Предстоятель', ['/page/pecnopenie/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Ccылка 1', ['/page/link1/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Ccылка 2', ['/page/link2/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Ccылка 3', ['/page/link3/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Вера', ['/page/vera/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Дети', ['/page/deti/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Культура', ['/page/kultura/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('История', ['/page/history/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Рубрики', ['/page/rubriki/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Архив', ['/page/arxiv/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('О проекте', ['/page/photos/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Предстоятель', ['/page/pecnopenie/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Ccылка 1', ['/page/link1/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Ccылка 2', ['/page/link2/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Ccылка 3', ['/page/link3/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Вера', ['/page/vera/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Дети', ['/page/deti/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Культура', ['/page/kultura/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('История', ['/page/history/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Рубрики', ['/page/rubriki/'], ['class' => 'profile-link text-info']);?></li>
                                    <li><?php echo Html::a('Архив', ['/page/arxiv/'], ['class' => 'profile-link text-info']);?></li>
                                </ul>*/?>
                            </div>
                        </div>
                        <div class="col-lg-2 <?php /*col-md-2 col-sm-2 col-sx-2*/?> col-md-10 col-sm-12 col-xs-12 pos-r">
                            <div class="row row-flex">
                                <div class="border border-secondary rounded p-1 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                    <div class="row center-block m-t10 pos-lg-am pos-md-am pos-r" >
                                        <div class="pos-a" style="left: 50%;z-index: 88888;left: 50%;z-index: 88888;bottom: 162px;margin-left: -72px;">
                                            <img src="/img/icons/icxp-middle.png" height="210">
                                        </div>
                                        <img src="/img/upb-footer-c354.jpg" alt="Изображение иконы" class="img-thumbnail">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 <?php /*col-md-5 col-sm-5 col-sx-5*/?> icxp-m-t10">
                            <div class="container-fluid push-right">
                                <div class="row row-flex icxp-r40-lg icxp-r40-md icxp-r40-sm icxp-r40-sx icxp-r40-sz icxp-r40-sf">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3 fl">
                                        <div class="content colour-1">
                                            <?php /*<h5>Первая колонка</h5>*/ ?>
                                            <p class="h5">
                                            <ul class="list-unstyled text-left">
                                                <li><?php echo Html::a('Фото', ['/page/photos/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Песнопения', ['/page/pecnopenie/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 1', ['/page/link1/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 2', ['/page/link2/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 3', ['/page/link3/'], ['class' => 'profile-link text-info']);?></li>
                                            </ul>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3 fl">
                                        <div class="content colour-1">
                                            <?php /*<h5>Первая колонка</h5>*/ ?>
                                            <p class="h5">
                                            <ul class="list-unstyled text-left">
                                                <li><?php echo Html::a('Фото', ['/page/photos/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Песнопения', ['/page/pecnopenie/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 1', ['/page/link1/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 2', ['/page/link2/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 3', ['/page/link3/'], ['class' => 'profile-link text-info']);?></li>
                                            </ul>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3 fl">
                                        <div class="content colour-1">
                                            <?php /*<h5>Первая колонка</h5>*/ ?>
                                            <p class="h5">
                                            <ul class="list-unstyled text-left">
                                                <li><?php echo Html::a('Фото', ['/page/photos/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Песнопения', ['/page/pecnopenie/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 1', ['/page/link1/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 2', ['/page/link2/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 3', ['/page/link3/'], ['class' => 'profile-link text-info']);?></li>
                                            </ul>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3 fl">
                                        <div class="content colour-1">
                                            <?php /*<h5>Первая колонка</h5>*/ ?>
                                            <p class="h5">
                                            <ul class="list-unstyled text-left">
                                                <li><?php echo Html::a('Фото', ['/page/photos/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Песнопения', ['/page/pecnopenie/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 1', ['/page/link1/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 2', ['/page/link2/'], ['class' => 'profile-link text-info']);?></li>
                                                <li><?php echo Html::a('Ccылка 3', ['/page/link3/'], ['class' => 'profile-link text-info']);?></li>
                                            </ul>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row <?php /* icxp-m-t68 icxp-p-t15 */?> col-lg-12 col-sm-12 c-999 bg-white row-flex p-r0 p-l0">
                <div class="copyright <?php /*pull-left*/?> col-lg-4 col-md-5 col-sm-5" style="margin-bottom: 20px;"><strong>&copy; Собор Успения Пресвятой Богородицы <?= date('Y') ?> </strong> <address style="margin-bottom: -15px !important;" class="icxp-fs-8t"><span class="icon-address"><span style="color:#337ab7;font-family: Arial;">ул.Университетская 11, г.Харьков,</span> <span class="fa-code"><span style="color:#337ab7;">61003</span></span> <abbr title="Phone" class="fa-icons glyphicon glyphicon glyphicon-phone-alt "></abbr>&nbsp;<span style="color:#337ab7;">(057) 456-7890</span>, <abbr title="Mobile Phone" class="glyphicon glyphicon-phone"></abbr>&nbsp;<span style="color:#337ab7;">(097) 456-7890</span></address></div>
                <div class="counters <?php /*pull-center*/?> col-lg-4  col-md-5 col-sm-5 icxp-m-b10">
                    <div class="text-center">
                        <span><a class="counter icxp-p-r5" href=""><img src="/img/icons/mailru-counters.png" ></a></span>
                        <span><a class="counter icxp-p-r5" href=""><img src="/img/icons/bigmir-net-counters.png" ></a></span>
                        <span><a class="counter icxp-p-r5" href=""><img src="/img/icons/pravoslavie-counters.png" height="31" ></a></span>
                        <span><a class="counter icxp-p-r5" href=""><img src="/img/icons/hotlog-counters.png" ></a></span>
                        <span><a class="counter icxp-p-r5" href=""><img src="/img/icons/yandex-ru-counters.png" ></a></span>
                        <span><a class="counter icxp-p-r5" href=""><img src="/img/icons/spylog-counters.png" ></a></span>
                        <span><a class="counter icxp-p-r5" href=""><img src="/img/icons/rambler-ru-counters.png" ></a></span>
                        <span><a class="counter icxp-p-r5" href=""><img src="/img/icons/logoslovo-ru-counters.png" ></a></span>
                        <span><a class="counter icxp-p-r5" href=""><img src="/img/icons/legprom-counters.png" ></a></span>
                        <span><a class="counter icxp-p-r5" href=""><img src="/img/icons/inter-ru-counters.png" ></a></span>
                        <span><a class="counter icxp-p-r5" href=""><img src="/img/icons/info-counters.png" ></a></span>
                        <span><a class="counter icxp-p-r5" href=""><img src="/img/icons/hithots-counters.png" ></a></span>
                        <?php /*
                    <script type="text/javascript" src="/orphus/orphus.js"></script>
                    <a href="http://orphus.ru" id="orphus" target="_blank" title="Orphus system"><img alt="Orphus system" src="/orphus/orphus.gif" border="0" height="31"></a>
                    <a href="//yandex.ru/cy?base=0&amp;host=foma.ru"><img src="//www.yandex.ru/cycounter?foma.ru" width="88" height="31" alt="Яндекс цитирования" border="0"></a>&nbsp;
                    <a href="http://www.hristianstvo.ru/?from=110"><img src="https://foma.ru/wp-content/themes/foma/images/ru-88x31-blue1.gif" title="Православное христианство.ru" width="88" height="31" border="0"></a>&nbsp; <script><!--
                            document.write("<a href='//www.liveinternet.ru/click' "+
                                "target=_blank><img src='//counter.yadro.ru/hit?t12.6;r"+
                                escape(document.referrer)+((typeof(screen)=="undefined")?"":
                                    ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                                        screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
                                ";"+Math.random()+
                                "' alt='' title='LiveInternet: показано число просмотров за 24"+
                                " часа, посетителей за 24 часа и за сегодня' "+
                                "border='0' width='88' height='31'><\/a>")
                            //--></script>
                    <a href="//www.liveinternet.ru/click" target="_blank"><img src="//counter.yadro.ru/hit?t12.6;rhttps%3A//foma.ru/moskovskiy-tserkovnyiy-vestnik-v-vecherney-moskve-stal-pervoy-pravoslavnoy-gazetoy-dlya-vseh.html;s1920*1080*24;uhttps%3A//foma.ru/cat/kultura;0.6400280361472441" alt="" title="LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодня" border="0" width="88" height="31"></a>&nbsp;   <span id="spylog2010639"></span><script> var spylog = { counter: 2010639, image: 16, next: spylog }; document.write(unescape('%3Cscript src%3D"//counter.spylog.com/cnt.js" defer="defer"%3E%3C/script%3E')); </script><script src="//counter.spylog.com/cnt.js" defer="defer"></script>  <a href="https://metrika.yandex.ru/stat/?id=1007672&amp;from=informer" target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/1007672/3_1_F55E27FF_D53E07FF_0_pageviews" style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="1007672" data-lang="ru"></a><script type="text/javascript">(function (d, w, c) {(w[c] = w[c] || []).push(function() {try {w.yaCounter1007672 = new Ya.Metrika2({id:1007672,clickmap:true,trackLinks:true,accurateTrackBounce:true,webvisor:true
                            });} catch(e) { }});var n = d.getElementsByTagName("script")[0],s = d.createElement("script"),f = function () { n.parentNode.insertBefore(s, n); };s.type = "text/javascript";s.async = true;s.src = "https://mc.yandex.ru/metrika/tag.js";
                                if (w.opera == "[object Opera]") {d.addEventListener("DOMContentLoaded", f, false);} else { f(); }})(document, window, "yandex_metrika_callbacks2");</script><noscript><div><img src="https://mc.yandex.ru/watch/1007672" style="position:absolute; left:-9999px;" alt="" /></div></noscript><script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
                            ga('create', 'UA-8838770-1', 'auto');ga('send', 'pageview');if (!document.referrer ||
                                document.referrer.split('/')[2].indexOf(location.hostname) != 0)
                                setTimeout(function(){ga('send', 'event', 'Новый посетитель', location.pathname);}, 15000);</script>*/?>
                    </div>
                 </div>
                <div class="createdby <?php /*pull-right*/?> col-lg-4 col-md-2 col-sm-2 text-right" style="height:54px;"><strong>Поддержка:</strong>
                    <!--<a href="http://rtvs.net" target="_blank">Техническая поддержка «Web Studio Rtvs»</a>-->
                    <address style="margin-bottom:20px !important; "> <a class="icxp glyphicon glyphicon-send" href="mailto:#">support@upb.info</a></address>
                </div>
                <?php /*<div class="back-to-top" id="back-top" style="display: block; left: 1497.5px;"> <a href="#top"><span>Наверх</span></a> </div>*/?>
            </div>
        </div>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
