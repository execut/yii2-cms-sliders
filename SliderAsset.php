<?php

namespace infoweb\sliders;

use yii\web\AssetBundle as AssetBundle;

class SliderAsset extends AssetBundle
{
    public $sourcePath = '@infoweb/sliders/assets/';

    public $css = [
    ];
    public $js = [
        'js/sliders.js',
    ];
    public $depends = [
        'backend\assets\AppAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\jui\JuiAsset',
    ];
}