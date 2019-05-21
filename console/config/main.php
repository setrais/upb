<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    /*'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
    ],*/
    'modules' => [
        'rbac' => [
            'class' => 'yii2mod\rbac\ConsoleModule'
        ]
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=upb',
            'username' => 'upb',
            'password' => 'upb1204!',
            /*'username' => 'root',
            'password' => '',*/
            'charset' => 'utf8',
        ],
    ],
    'modules' => [
        'social' => [
            // the module class
            'class' => 'kartik\social\Module',

            // the global settings for the disqus widget
            'disqus' => [
                'settings' => ['shortname' => 'DISQUS_SHORTNAME'] // default settings
            ],

            // the global settings for the facebook plugins widget
            'facebook' => [
                'app_id' => 'FACEBOOK_APP_ID',
                'app_secret' => 'FACEBOOK_APP_SECRET',
            ],

            // the global settings for the google plugins widget
            'google' => [
                'clientId' => 'GOOGLE_API_CLIENT_ID',
                'pageId' => 'GOOGLE_PLUS_PAGE_ID',
                'profileId' => 'GOOGLE_PLUS_PROFILE_ID',
            ],

            // the global settings for the google analytic plugin widget
            'googleAnalytics' => [
                'id' => 'TRACKING_ID',
                'domain' => 'TRACKING_DOMAIN',
            ],

            // the global settings for the twitter plugins widget
            'twitter' => [
                'screenName' => 'TWITTER_SCREEN_NAME'
            ],
        ],
        // your other modules
    ],
    'params' => $params,
];
