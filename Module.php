<?php

namespace infoweb\sliders;

use yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'infoweb\sliders\controllers';

	/*
	public $rules = [
		'<module:\w+>/<action:\w+>/<id:(.*?)>' => '<module>/default/<action>/<id>',
		'<module:\w+>/<action:\w+>' => '<module>/default/<action>',
	];
	*/

    public function init()
    {
        parent::init();

	    Yii::configure($this, require(__DIR__ . '/config.php'));

	    //\infoweb\sliders\Module::getInstance()->thumbnailDimensions

	    //Yii::$app->getUrlManager()->addRules($this->rules);


    }
}
