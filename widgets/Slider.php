<?php
namespace infoweb\sliders\widgets;

use Yii;
use yii\bootstrap\Widget;
use infoweb\sliders\models\Slider as SliderItem;

class Slider extends Widget
{
    public $template = 'slider';
    public $id = 0;
    
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        $slider = SliderItem::findOne($this->id);

        return $this->render($this->template, ['images' => $slider->getImages(), 'slider' => $slider]);
    }
}
