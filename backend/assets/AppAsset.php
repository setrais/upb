<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/reset.css',
        'css/site.css',
        'css/helper.css',
        'css/helper-bootstrap.css',
        'css/jquery.fancybox.css',
        'css/helper-my.css',
        //'css/main.css',
        //'bootstrap-sb-admin/vendor/bootstrap/css/bootstrap.min.css',
        //'bootstrap-sb-admin/vendor/fontawesome-free/css/all.min.css',
        //'bootstrap-sb-admin/vendor/datatables/dataTables.bootstrap4.css',
        //'bootstrap-sb-admin/css/sb-admin.css'
    ];
    public $js = [
        'js/jquery.fancybox.js',
	];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        //'backend\assets\SbAdminAsset',
        /*'p2m\assets\P2CoreAsset',
        'p2m\sbAdmin\assets\SBAdmin2Asset',
        'p2m\assets\AnimateAsset',
        'p2m\assets\BootstrapAsset',
        'p2m\assets\BootstrapSocialAsset',
        'p2m\assets\BootstrapSweetalertAsset',
        'p2m\assets\BootstrapSwitchAsset',
        'p2m\assets\CircleButtonsAsset',
        'p2m\assets\ColorHelpersAsset',
        'p2m\assets\DataTablesBundleAsset',
        'p2m\assets\datatables\DataTablesAutoFillAsset',
        'p2m\assets\datatables\DataTablesBootstrapAsset',
        'p2m\assets\datatables\DataTablesButtonsAsset',
        'p2m\assets\datatables\DataTablesColReorderAsset',
        'p2m\assets\datatables\DataTablesColVisAsset',
        'p2m\assets\datatables\DataTablesFixedColumnsAsset',
        'p2m\assets\datatables\DataTablesFixedHeaderAsset',
        'p2m\assets\datatables\DataTablesFlashExportAsset',
        'p2m\assets\datatables\DataTablesHTML5ExportAsset',
        'p2m\assets\datatables\DataTablesKeyTableAsset',
        'p2m\assets\datatables\DataTablesPrintViewAsset',
        'p2m\assets\datatables\DataTablesResponsiveAsset',
        'p2m\assets\datatables\DataTablesRowReorderAsset',
        'p2m\assets\datatables\DataTablesScrollerAsset',
        'p2m\assets\datatables\DataTablesSelectAsset',
        'p2m\assets\EkkoLightboxAsset',
        'p2m\assets\FitvidsAsset',
        'p2m\assets\FlagIconCssAsset',
        'p2m\assets\FlotBundleAsset',
        'p2m\assets\flot\FlotAsset',
        'p2m\assets\flot\FlotAssetBase',
        'p2m\assets\flot\FlotCanvasAsset',
        'p2m\assets\flot\FlotCategoriesAsset',
        'p2m\assets\flot\FlotChartsAsset',
        'p2m\assets\flot\FlotCrosshairAsset',
        'p2m\assets\flot\FlotErrorbarsAsset',
        'p2m\assets\flot\FlotFillbetweenAsset',
        'p2m\assets\flot\FlotImageAsset',
        'p2m\assets\flot\FlotNavigateAsset',
        'p2m\assets\flot\FlotPieAsset',
        'p2m\assets\flot\FlotResizeAsset',
        'p2m\assets\flot\FlotSelectionAsset',
        'p2m\assets\flot\FlotStackAsset',
        'p2m\assets\flot\FlotSymbolAsset',
        'p2m\assets\flot\FlotThresholdAsset',
        'p2m\assets\flot\FlotTimeAsset',
        'p2m\assets\flot\FlotTooltipAsset',
        'p2m\assets\FontAwesomeAsset',
        'p2m\assets\FullCalendarAsset',
        'p2m\assets\FullCalendarPrintAsset',
        'p2m\assets\GMapsApiAsset',
        'p2m\assets\GMapsAsset',
        'p2m\assets\HolderAsset',
        'p2m\assets\IsotopeAsset',
        'p2m\assets\JqueryAsset',
        'p2m\assets\JqueryCountToAsset',
        'p2m\assets\JqueryMigrateAsset',
        'p2m\assets\JSZipAsset',
        'p2m\assets\JuiAsset',
        'p2m\assets\Lightbox2Asset',
        'p2m\assets\MasonryAsset',
        'p2m\assets\MetisMenuAsset',
        'p2m\assets\MomentAsset',
        'p2m\assets\MomentTimezoneAsset',
        'p2m\assets\MorrisAsset',
        'p2m\assets\PdfMakeAsset',
        'p2m\assets\PrettyPhotoAsset',
        'p2m\assets\QunitAsset',
        'p2m\assets\RaphaelAsset',
        'p2m\assets\SweetAlertAsset',
        'p2m\assets\TimelineAsset',
        'p2m\assets\TimelineCssAsset',
        'p2m\assets\WowAsset',*/
    ];
}
