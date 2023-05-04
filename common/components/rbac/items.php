<?php
return [
    'superadmin' => [
        'type' => 1,
        'description' => 'Суперадмин',
        'ruleName' => 'userRole',
        'children' => [
            'guest',
            'delete',
            'update',
        ],
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Админ',
        'ruleName' => 'userRole',
        'children' => [
            'guest',
            'delete',
            'update',
        ],
    ],
    'expert' => [
        'type' => 1,
        'description' => 'Експерт',
        'ruleName' => 'userRole',
        'children' => [
            'guest',
            'update',
        ],
    ],
    'manager' => [
        'type' => 1,
        'description' => 'Менедхер',
        'ruleName' => 'userRole',
        'children' => [
            'guest',
        ],
    ],
    'menber' => [
        'type' => 1,
        'description' => 'Сотрудник',
        'ruleName' => 'userRole',
        'children' => [
            'guest',
        ],
    ],
    'guest' => [
        'type' => 1,
        'description' => 'Гость',
        'ruleName' => 'userRole',
        'children' => [
            'login',
            'logout',
            'error',
            'sign-up',
            'index',
            'view',
        ],
    ],
    'unverified' => [
        'type' => 1,
        'description' => 'Неверифицирован',
        'ruleName' => 'userRole',
        'children' => [
            'guest',
        ],
    ],
    'verified' => [
        'type' => 1,
        'description' => 'Верифицирован',
        'ruleName' => 'userRole',
        'children' => [
            'guest',
        ],
    ],
    'unapproved' => [
        'type' => 1,
        'description' => 'Неодобрен',
        'ruleName' => 'userRole',
        'children' => [
            'guest',
        ],
    ],
    'approved' => [
        'type' => 1,
        'description' => 'Одобрен',
        'ruleName' => 'userRole',
        'children' => [
            'guest',
        ],
    ],
    'user' => [
        'type' => 1,
        'description' => 'Пользователь',
        'ruleName' => 'userRole',
        'children' => [
            'guest',
        ],
    ],
    'author' => [
        'type' => 1,
        'description' => 'Автор',
        'ruleName' => 'userRole',
        'children' => [
            'guest',
            'update',
            'updateOwnProfile',
        ],
    ],
    'login' => [
        'type' => 2,
        'description' => 'Логин',
    ],
    'logout' => [
        'type' => 2,
        'description' => 'Выход',
    ],
    'error' => [
        'type' => 2,
        'description' => 'Ошибка',
    ],
    'sign-up' => [
        'type' => 2,
        'description' => 'Вспомнить пароль',
    ],
    'index' => [
        'type' => 2,
        'description' => 'Административная панель',
    ],
    'view' => [
        'type' => 2,
        'description' => 'Просмотр',
    ],
    'update' => [
        'type' => 2,
        'description' => 'Редактирование',
    ],
    'delete' => [
        'type' => 2,
        'description' => 'Удаление',
    ],
    'updateOwnProfile' => [
        'type' => 2,
        'ruleName' => 'isProfileOwner',
    ],
];
