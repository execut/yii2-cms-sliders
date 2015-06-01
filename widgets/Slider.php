<?php
namespace infoweb\sliders\widgets;

use Yii;
use yii\bootstrap\Widget;
use infoweb\sliders\models\Slider as SliderItem;
use yii\helpers\Html;

class Slider extends Widget
{
    public $template = 'slider';
    public $controls = '';
    public $id = 0;
    
    public function init()
    {
        parent::init();

        if ($this->controls == null) {
            $this->controls = [
                '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span>',
                '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span>'
            ];
        }
    }
    
    public function run()
    {
        $slider = SliderItem::findOne($this->id);

        $items = [];

        foreach ($slider->getImages() as $image) {
            $items[] = [
                'content' => Html::img($image->getUrl("{$slider->width}x{$slider->height}"), ['alt' => $image->alt, 'title' => $image->title]),
                'caption' => $image->title,
                'options' => [],
            ];
        }

        return $this->render($this->template, ['items' => $items, 'controls' => $this->controls]);
    }
}
