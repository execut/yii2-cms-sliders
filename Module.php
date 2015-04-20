<?php

namespace infoweb\sliders;

use yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'infoweb\sliders\controllers';

    public $options = [];

    public function init()
    {
        parent::init();

	    Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
