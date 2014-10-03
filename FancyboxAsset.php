<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace infoweb\sliders;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Fancybox asset files
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FancyboxAsset extends AssetBundle
{
    public $sourcePath = '@bower/fancybox/source';
    public $css = [
        'jquery.fancybox.css'
    ];
    public $js = [
        'jquery.fancybox.pack.js'
    ];
}
