<?php
//echo "<pre>".phpinfo()."</pre>";
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

use \yii\web\Request;
$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        /*'request' => [
            'csrfParam' => '_csrf-frontend',
        ],*/
        'request' => [
             'baseUrl' => $baseUrl,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix'=>'/',
            'rules'=>array(
                ''=>'site/index',
                '<action>'=>'site/<action>',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ),
        ],
        /*'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],*/
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app'       => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'tagcloud' => [
            'class' => 'dongrim\tagcloud\Module',
            'tags'=>[
                [
                    'model'=>'app\models\Iblocks',
                    'attribute'=>'tags',
                    'type'=>'post'
                ],
                /*[
                    'model'=>'app\models\Post',
                    'attribute'=>'tags',
                    'type'=>'post'
                ],*/
                /*[
                    'model'=>'app\models\Gallery',
                    'attribute'=>'tags',
                    'type'=>'gallery'
                ],*/

            ],
            //  'customView' =>'',
            //  'customLink' =>'',
            //  'customWidgetView' =>''
        ],
    ],
    'params' => $params,
];
