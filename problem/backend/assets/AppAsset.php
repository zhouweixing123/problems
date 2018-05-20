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
        'css/site.css',
        'css/bootstrap.min.css',
        'css/style.css',
        'css/morris.css',
        'css/font-awesome.css',
        'css/icon-font.min.css',
        'css/common.css',
    ];
    public $js = [
        'js/jquery.nicescroll.js',
        'js/bootstrap.min.js',
        'js/raphael-min.js',
        'js/morris.js',
        'js/logout.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    // 定义按需加载JS的方法
    public static function addJs($view,$jsFile){
        $view -> registerJsFile($jsFile,[AppAsset::className(),'depends' => 'backend\assets\AppAsset']);
    }
    // 定义按需加载CSS的方法
    public static function addCss($view,$cssFile){
        $view -> registerCssFile($cssFile,[AppAsset::className(),'depends' => 'backend\assets\AppAsset']);
    }
}
