<?php
/**
 * Created by PhpStorm.
 * User: setrais
 * Date: 20.12.2018
 * Time: 17:28
 */
namespace api\modules\v2;

use Yii;
use yii\base\Module as BaseModule;
use yii\web\GroupUrlRule;

/**
 * Class Module
 *
 * @package backend\modules\api
 * api module definition class
 */
class Module extends BaseModule
{
    /*
    const VERSION = '0.0.2';

    /**
     * @inheritdoc
     *
    public $controllerNamespace = 'backend\modules\api\controllers';

    /**
     * @var string The prefix for user module URL.
     *
     * @See [[GroupUrlRule::prefix]]
     *
    public $urlPrefix = 'api';

    /** @var array The rules to be used in URL management.
    public $urlRules = [
        [
            'verb' => ['PUT','PATCH'],
            'pattern' => '<controller:[\w\-]+>/id:\w+>',
            'route' => '<controller>/update',
        ],
        [
            'verb' => ['DELETE'],
            'pattern' => '<controller:[\w\-]+>/id:\w+>',
            'route' => '<controller>/delete',
        ],
        [
            'verb' => ['GET','HEAD'],
            'pattern' => '<controller:[\w\-]+>/id:\w+>',
            'route' => '<controller>/view',
        ],
        [
            'verb' => ['POST'],
            'pattern' => '<controller:[\w\-]+>/id:\w+>',
            'route' => '<controller>/create',
        ],
        [
            'verb' => ['GET','HEAD'],
            'pattern' => '<controller:[\w\-]+>/id:\w+>',
            'route' => '<controller>/index',
        ],
        [
            'verb' => ['GET','HEAD'],
            'pattern' => '<controller:[\w\-]+>/id:\w+>',
            'route' => '<controller>/<action>',
        ]
    ];

    /**
     * @inheritdoc
     *
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {

            $app->getUrlManager->addRules([
                new GroupUrlRule([
                    "prefix" => $this->urlPrefix,
                    "rules" => $this->urlRules,
                ]),
            ], false);
        }
    }

    /**
     * @inheritdoc
     *
    public function init()
    {
        parent::init();

        if ( Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'backend\modules\api\commands';
        }
        Yii::$app->urlManager->addRules([
            new GroupUrlRule([
                "prefix" => $this->urlPrefix,
                "rules" => $this->urlRules,
            ]),
        ], false);
    }
    */
    public $controllerNamespace = 'api\modules\v2\controllers';
    public function init()
    {
        parent::init();
    }
}
