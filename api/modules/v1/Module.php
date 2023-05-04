<?php
/**
 * Created by PhpStorm.
 * User: setrais
 * Date: 20.12.2018
 * Time: 17:28
 */
namespace api\modules\v1;

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
    /**/
    const VERSION = '0.0.2';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'api\modules\v1\controllers';

    /**
     * @var string The prefix for user module URL.
     *
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix = 'api';

    /** @var array The rules to be used in URL management. */
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
     */
    public function init()
    {
        //exit();

        parent::init();

        if ( Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'api\modules\v1\commands';
        }
        Yii::$app->urlManager->addRules([
            new GroupUrlRule([
                "prefix" => $this->urlPrefix,
                "rules" => $this->urlRules,
            ]),
        ], false);
    }
}
