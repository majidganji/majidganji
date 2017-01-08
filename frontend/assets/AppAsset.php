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
//        'css/bootstrap.min.css',
        'css/mdb.min.css',
        'css/bootstrap-rtl.min.css',
        'css/font-awesome.min.css',
        'css/site.css',
        'css/font.css',
    ];
    public $js = [
        'js/mdb.min.js',
        'js/tether.min.js',
        'js/lobibox.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
