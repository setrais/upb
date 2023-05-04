<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

use \yii\web\Request;
$baseUrl = str_replace('/api/web', '', (new Request)->getBaseUrl());
return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ],
        'v2' => [
            'basePath' => '@app/modules/v2',
            'class' => 'api\modules\v2\Module'
        ],
    ],
    'components' => [
        /*'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->data !== null && !empty(Yii::$app->request->get('suppress_response_code'))) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'data' => $response->data,
                    ];
                    $response->statusCode = 200;
                }
            },
        ],*/
        'response' => [
            'class' => 'yii\web\Response',
            'format' => 'json',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->data !== null) {
                    $data = $response->data;
                    // Error handle
                    $error = '';
                    if (!$response->isSuccessful) {
                        if(isset($data['message'])) {
                            $error = $data['message'];
                        } elseif(isset(current($data)['message'])) {
                            $error = current($data)['message'];
                        }
                    }
                    $response->data = [
                        'result' => $response->isSuccessful,
                        'code' => $response->statusCode,
                        'error' => $error,
                    ];
                    if ($response->isSuccessful) {
                        $response->data = [
                            'result' => $data,
                        ];
                    }
                }
            },
        ],
        'request' => [
            'baseUrl' => $baseUrl . "/api", // Обезательная вещь
            'class' => '\yii\web\Request',
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'application/xml' => 'yii\web\XmlParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            //'enableAutoLogin' => false,
            'enableSession' => false,
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/user',  'tokens' => [
                    '{id}' => '<id:\\w+>'
                ]],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/iblock','tokens' => [
                    '{id}' => '<id:\\w+>'
                ]],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/file','tokens' => [
                    '{id}' => '<id:\\w+>'
                ]],
            ],
        ],
        'i18n' => [
            'translations' => [
                /*'app/iblock' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceMessageTable'=>'{{%source_message}}',
                    'messageTable'=>'{{%message}}',
                    'enableCaching' => true,
                    'cachingDuration' => 10,
                    'forceTranslation'=> true,
                ],*/
                /*'*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceMessageTable'=>'{{%source_message}}',
                    'messageTable'=>'{{%message}}',
                    'enableCaching' => false,
                    'cachingDuration' => 10,
                    'forceTranslation'=> true,
                ],*/
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'app'         => 'app.php',
                        'app/iblocks' => 'iblocks.php',
                        'app/error'   => 'error.php',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];


