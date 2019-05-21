<?php
/**
 * Created by PhpStorm.
 * User: setrais
 * Date: 27.12.2018
 * Time: 11:42
 */

namespace common\components\rbac;


use Yii;
use yii\rbac\Rule;

class UserRoleRule extends Rule
{

    public $name = 'userRole';

    public function execute($user, $item, $params)
    {
        //$roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());

        return true;

        // Обработка группы
        /*if ( !Yii::$app->user->isGuest ) {
            //$group = Yii::$app->user->identity->group;
            if ( $item->name === 'superadmin') {
                return true;
                //return $group == 1;
            } elseif ($item->name === 'author') {
                //return $group == 1 || $group == 2;
            } elseif ($item->name === 'quest') {
                //return $group == 1;
            }
        }
        return false;*/
    }

    /** Для пользователя с опеределенной ролью https://klisl.com/rbac.html
     * $user - id текущего пользователя
     * $item - объект роли которую проверяем у текущего пользователя
     * $params - параметры, которые можно передать для проведеня проверки в данный класс
     *
    public function execute($user, $item, $params)
    {
        //Получаем объект текущего пользователя из базы
        $user = ArrayHelper::getValue($params, 'user', User::findOne($user));

        if ($user) {
            $role = $user->role;

            if ($item->name === 'admin') {
                return $role == User::ROLE_ADMIN;
            }
            elseif ($item->name === 'moder') {
                return $role == User::ROLE_ADMIN || $role == User::ROLE_MODER;
            }
            elseif ($item->name === 'user') {
                return $role == User::ROLE_ADMIN || $role == User::ROLE_MODER
                    || $role == User::ROLE_USER;
            }
        }

        return false;
    }*/

}