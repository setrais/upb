<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);


use \yii\web\Request;
$baseUrl = str_replace('/backend/web', '', (new Request)->getBaseUrl());


$config =  [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'language' => "ru-RU",
    'sourceLanguage' => 'ru',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    /*'controllerMap' => [
        'sbadmin' => 'johnsnook\sbadmin\controllers\SbAdminController',
    ],*/
    /*controllerMap' => [
        'assignment' => [
            'class' => 'yii2mod\rbac\controllers\AssignmentController',
            'userIdentityClass' => 'backend\models\User',
            'searchClass' => [
                'class' => 'yii2mod\rbac\models\search\AssignmentSearch',
                'pageSize' => 10,
            ],
            'idField' => 'id',
            'usernameField' => 'username',
            'gridViewColumns' => [
                'id',
                'username',
                'email'
            ],
        ],
    ],*/
    'modules' => [
        /*'rbac' => [
          'class' => 'yii2mod\rbac\Module',
          'as access' => [
               'class' => yii2mod\rbac\filters\AccessControl::class
          ],
        ],*/
        'rbac' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    //'userClassName' => 'dektrium\user\models\User',
                    'userClassName' => 'common\models\User',
                    'idField' => 'id',
                ],
            ],
            'menus' => [
                'assignment' => [
                    'label' => 'Users'
                ],
                'route' => null,
            ],
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            'allowedIPs' => ['127.0.0.1', '::1', '109.86.1.65'],
        ],
        'service' => [
            'class' => 'backend\modules\service\Module',
            // ... другие настройки модуля ...
        ],
    ],
    'components' => [
        /*'view' => [
            'theme' => [
                'pathMap' => [
                    //'@app/views/layouts' => '@app/views/sb-admin-2/layouts', // For simple
                    '@app/views' => '@app/views/sb-admin-2', // For simple
                    //'@app/views/layouts' => '@vendor/simple-projects/yii2-sbadmin/views/layouts', // For simple
                    //'@app/views' => '@vendor/p2made/yii2-p2y2-things-demo/views',
                    //'@app/views' => '@vendor/p2made/yii2-sb-admin-theme/views/sb-admin-2', // For sb-admin
                ],
            ],
        ],*/
        /*'request' => [
            'csrfParam' => '_csrf-backend',
        ],*/
        'request' => [
            'baseUrl' => $baseUrl . "/admin",
            'parsers' => [  // Включение JSON на прием данных
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            // For sb-admin
            /*'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null, 'js' => [],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null, 'css' => [],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => null, 'js' => [],
                ],
                'yii\jui\JuiAsset' => [
                    'sourcePath' => null, 'css' => [], 'js' => [],
                ],
                '\rmrevin\yii\fontawesome\AssetBundle' => [
                    'sourcePath' => null, 'css' => [],
                ],
            ],*/
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    //'css' => [],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true, // Человекочетабельный URL
            'enableStrictParsing' => true, // Строгий ращбор URL
            'showScriptName' => false, // Включение имени скрипта (index.php) в URL
            'suffix'=>'/',
            'rules'=>array(
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user', 'pluralize'=>false],
                ''=>'site/index',
                'rbac'=>'rbac',
                '<action>'=>'site/<action>',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>/' => '<module>/<controller>/<action>',

            ),
        ],
        /*'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],*/
        'authManager' => [

            // yii2mod/yii2-rbac
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest', 'user'],

            /* Standart
            'class' => 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
            'defaultRoles' => ['guest', 'author', 'superadmin', 'admin' ],
            'itemFile' => '@common/components/rbac/items.php',
            'assignmentFile' => '@common/components/rbac/assignments.php',
            'ruleFile' => '@common/components/rbac/rules.php',*/

            /*'class' => 'yii\rbac\DbManager',
            'itemTable'       => 'auth_item',
            'itemChildTable'  => 'auth_item_child',
            'assignmentTable' => 'auth_assignment',
            'ruleTable'       => 'auth_rule',
            'defaultRoles'    => ['guest'],*/
        ],
        /*'as access' => [
            'class' => 'mdm\admin\components\AccessControl',
            'allowActions' => [
                'site/*',
                'admin/*',
                'some-controller/some-action',
                // The actions listed here will be allowed to everyone including guests.
                // So, 'admin/*' should not appear here in the production, of course.
                // But in the earlier stages of your development, you may probably want to
                // add a lot of actions here until you finally completed setting up rbac,
                // otherwise you may not even take a first step.
            ]
        ],*/
        'as access' => [
            'class' => yii2mod\rbac\filters\AccessControl::class,
            'allowActions' => [
                'site/*',
                'admin/*',
                // The actions listed here will be allowed to everyone including guests.
                // So, 'admin/*' should not appear here in the production, of course.
                // But in the earlier stages of your development, you may probably want to
                // add a lot of actions here until you finally completed setting up rbac,
                // otherwise you may not even take a first step.
            ]
        ],
        'i18n' => [
            'translations' => [
                'app/iblock' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceMessageTable'=>'{{%source_message}}',
                    'messageTable'=>'{{%message}}',
                    'enableCaching' => true,
                    'cachingDuration' => 10,
                    'forceTranslation'=> true,
                ],
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceMessageTable'=>'{{%source_message}}',
                    'messageTable'=>'{{%message}}',
                    'enableCaching' => false,
                    'cachingDuration' => 10,
                    'forceTranslation'=> true,
                ],
                'yii2mod.rbac' => [
                        'class' => 'yii\i18n\PhpMessageSource',
                        'basePath' => '@yii2mod/rbac/messages',
                ],
                /*'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'app'         => 'app.php',
                        'app/iblocks' => 'iblocks.php',
                        'app/error'   => 'error.php',
                    ],
                ],*/
            ],
        ],
    ],
    'params' => $params,
];

if ( ! YII_DEBUG ) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

if ( YII_ENV ) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
    /*$config['bootstrap'][] = 'rbac';
    $config['modules']['rbac'] = [
        'class' => 'yii2mod\rbac\Module',
    ];*/

}

return $config;