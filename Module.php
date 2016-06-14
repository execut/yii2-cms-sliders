<?php

namespace infoweb\sliders;

use yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'infoweb\sliders\controllers';

    /**
     * The default with of a slider
     * @var int
     */
    public $defaultWith = 800;

    /**
     * The default height of a slider
     * @var int
     */
    public $defaultHeight = 200;

    /**
     * Enable the 'title' attribute for image's
     * @var boolean
     */
    public $enableImageTitle = false;

    /**
     * Enable the 'subtitle' attribute for image's
     * @var boolean
     */
    public $enableImageSubTitle = false;

    /**
     * Enable the 'description' attribute for image's
     * @var boolean
     */
    public $enableImageDescription = false;

    /**
     * Enable the 'url' attribute for image's
     * @var boolean
     */
    public $enableImageUrl = false;

    /**
     * Enable the 'position' attribute for image's
     * @var boolean
     */
    public $enableTextPosition = false;

    public function init()
    {
        parent::init();

	    Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
