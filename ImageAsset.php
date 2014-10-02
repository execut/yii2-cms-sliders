<?php

namespace infoweb\sliders;

use yii\web\AssetBundle as AssetBundle;

class ImageAsset extends AssetBundle
{
    public $sourcePath = '@infoweb/sliders/assets/';

    // @todo Add fancybox as bower asset
    public $css = [
        'css/jquery.fancybox.css',
    ];
    public $js = [
        'js/images.js',
        'js/jquery.fancybox.pack.js',
    ];
    public $depends = [
        'backend\assets\AppAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\jui\JuiAsset',
    ];
}