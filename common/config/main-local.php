<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            //'dsn' => 'mysql:host=localhost;dbname=luxrealty',
            //'dsn' => 'mysql:host=localhost;dbname=ucpeniepb',
            'dsn' => 'mysql:host=localhost;dbname=upb',
            /*'username' => 'upb',
            'password' => 'upb1204!',*/
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
