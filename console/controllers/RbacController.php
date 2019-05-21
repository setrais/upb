<?php
/**
 * Created by PhpStorm.
 * User: setrais
 * Date: 27.12.2018
 * Time: 11:40
 */

namespace console\controllers;


use Yii;
use yii\console\Controller;
use common\components\rbac\UserRoleRule;
use common\components\rbac\UserProfileOwnerRule;
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll(); // Удаляем старые данные

        // Добавляем объект определяющий правила для ролей пользователей, он будет сохранен в файл rules.php
        $rule = new UserRoleRule();
        $auth->add($rule);

        // Создание ролей / Create roles
        $superadmin = $auth->createRole('superadmin');
        $superadmin->description = 'Суперадмин';
        $superadmin->ruleName = $rule->name;
        $auth->add($superadmin);

        $admin = $auth->createRole('admin');
        $admin->description = 'Админ';
        $admin->ruleName = $rule->name;
        $auth->add($admin);

        $expert = $auth->createRole('expert');
        $expert ->description = 'Експерт';
        $expert ->ruleName = $rule->name;
        $auth->add($expert);

        $manager = $auth->createRole('manager');
        $manager->description = 'Менедхер';
        $manager->ruleName = $rule->name;
        $auth->add($manager);

        $member = $auth->createRole('menber');
        $member->description = "Сотрудник";
        $member->ruleName = $rule->name;
        $auth->add($member);

        $guest = $auth->createRole('guest');
        $guest->description = "Гость";
        $guest->ruleName = $rule->name;
        $auth->add($guest);

        $unverified = $auth->createRole('unverified');
        $unverified->description = 'Неверифицирован';
        $unverified->ruleName = $rule->name;
        $auth->add($unverified);

        $verified = $auth->createRole('verified');
        $verified->description = 'Верифицирован';
        $verified->ruleName = $rule->name;
        $auth->add($verified);

        $unapproved = $auth->createRole('unapproved');
        $unapproved->description = 'Неодобрен';
        $unapproved->ruleName = $rule->name;
        $auth->add($unapproved);

        $approved = $auth->createRole( 'approved');
        $approved->description="Одобрен";
        $approved->ruleName = $rule->name;
        $auth->add($approved);

        $user  = $auth->createRole('user');
        $user->description='Пользователь';
        $user->ruleName = $rule->name;
        $auth->add($user);

        $author = $auth->createRole('author');
        $author->description = 'Автор';
        $author->ruleName = $rule->name;
        $auth->add($author);


        // Создание права доступа к входу | Сreate simple, based on action{$NAME} permissions
        // Создадим для прмера права для доступа к админке
        $login = $auth->createPermission('login');
        $login->description = "Логин";
        $auth->add($login);

        $logout = $auth->createPermission('logout');
        $logout->description = "Выход";
        $auth->add($logout);

        $error  = $auth->createPermission('error');
        $error->description = "Ошибка";
        $auth->add($error);

        $signUp = $auth->createPermission('sign-up');
        $signUp->description = 'Вспомнить пароль';
        $auth->add($signUp);

        $index = $auth->createPermission('index');
        $index->description = 'Административная панель';
        $auth->add($index);

        $view   = $auth->createPermission('view');
        $view->description = 'Просмотр';
        $auth->add($view);

        $update = $auth->createPermission('update');
        $update->description = 'Редактирование';
        $auth->add($update);

        $delete = $auth->createPermission('delete');
        $delete ->description = 'Удаление';
        $auth->add($delete);


        // Добвление разшений роля | Add permission-per-role in Yii::$app->authManager

        // Guest
        $auth->addChild($guest, $login);
        $auth->addChild($guest, $logout);
        $auth->addChild($guest, $error);
        $auth->addChild($guest, $signUp);
        $auth->addChild($guest, $index);
        $auth->addChild($guest, $view);

        // Superadmin
        $auth->addChild($superadmin, $guest);
        $auth->addChild($superadmin, $delete);
        $auth->addChild($superadmin, $update);

        // Admin
        $auth->addChild($admin, $guest);
        $auth->addChild($admin, $delete);
        $auth->addChild($admin, $update);

        // Expert
        $auth->addChild($expert, $guest);
        $auth->addChild($expert, $update);

        // Manager
        $auth->addChild($manager, $guest);

        // Member
        $auth->addChild($member, $guest);

        // Unverified
        $auth->addChild($unverified,$guest);
        // Verified
        $auth->addChild($verified,$guest);

        // Unapproved
        $auth->addChild($unapproved, $guest);
        // Approved
        $auth->addChild($approved, $guest);

        // User
        $auth->addChild($user, $guest);

        // Author
        $auth->addChild($author, $guest);
        $auth->addChild($author, $update);

        // Добавление правила } Add the rule
        $userRule = new UserProfileOwnerRule();
        $auth->add($userRule);

        // Cоздание разрешения
        $updateOwnProfile = $auth->createPermission('updateOwnProfile');
        $updateOwnProfile->ruleName = $userRule->name;
        // Добвление разрешения
        $auth->add($updateOwnProfile);
        $auth->addChild($author, $updateOwnProfile);

        $userRole = Yii::$app->authManager->getRole('superadmin');
        Yii::$app->authManager->assign($userRole, 1/*$user->getId()*/);

    }
}