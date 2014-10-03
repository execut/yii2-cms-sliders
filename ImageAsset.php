<?php

namespace infoweb\sliders;

use yii\web\AssetBundle as AssetBundle;

class ImageAsset extends AssetBundle
{
    public $sourcePath = '@infoweb/sliders/assets/';

    public $css = [
    ];
    public $js = [
        'js/images.js',
    ];
    public $depends = [
        'backend\assets\AppAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\jui\JuiAsset',
        'infoweb\sliders\BootboxAsset',
        'infoweb\sliders\BootstrapGrowlAsset',
        'infoweb\sliders\FancyboxAsset',
    ];
}