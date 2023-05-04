<?php

namespace backend\modules\service;

use Yii;
use yii2mod\rbac\filters\AccessControl;

/**
 * Module module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\service\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            AccessControl::class
        ];
    }
}
