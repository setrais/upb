<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/reset.css',
        'css/site.css',
        'css/helper.css',
        'css/helper-bootstrap.css',
        'css/helper-my.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'powerkernel\bootstrapsocial\BootstrapsocialAsset',
        'powerkernel\fontawesome\FontawesomeAsset',
        'kartik\icons\WhhgAsset',
        //'justinvoelker\tagging\TaggingAsset',
    ];

    public function init()
    {
        parent::init();
        // resetting BootstrapAsset to not load own css files
        /*\Yii::$app->assetManager->bundles['yii\\bootstrap\\BootstrapAsset'] = [
            'css' => [],
            'js' => []
        ];*/
    }
}
