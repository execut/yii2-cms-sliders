<?php

namespace infoweb\sliders;

use yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'infoweb\sliders\controllers';

    public $options = [];
    
    /**
     * The default with of a slider
     * @var int
     */
    public $defaultWith;
    
    /**
     * The default height of a slider
     * @var int
     */
    public $defaultHeigth;

    public function init()
    {
        parent::init();

	    Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
