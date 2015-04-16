<?php

namespace infoweb\sliders\assets;

use yii\web\AssetBundle as AssetBundle;

class SliderAsset extends AssetBundle
{
    public $sourcePath = '@infoweb/sliders/assets/';

    public $js = [
        'js/sliders.js',
    ];

    public $depends = [
        'backend\assets\AppAsset',
        'yii\web\YiiAsset',
        'yii\jui\JuiAsset',
    ];
}