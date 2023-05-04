<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class SbAdminAsset extends AssetBundle
{
   /* public $sourcePath = '@bower/bootstrap-sb-admin';
    public $baseUrl = '@web';
    public $css = [
        'vendor/datatables/dataTables.bootstrap4.css',
        'css/sb-admin.css'
    ];
    public $js = [
        'vendor/jquery-easing/jquery.easing.min.js',
        'vendor/chart.js/Chart.min.js',
        'vendor/datatables/jquery.dataTables.js',
        'vendor/datatables/dataTables.bootstrap4.js',
        'js/sb-admin.js',
        'js/demo/datatables-demo.js',
        'js/demo/chart-area-demo.js'
    ];*/
    public $depends = ['p2m\sbAdmin\assets\SBAdmin2Asset'];
}
