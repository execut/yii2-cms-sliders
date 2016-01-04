<?php
namespace infoweb\sliders\widgets;

use Yii;
use yii\bootstrap\Widget;
use infoweb\sliders\models\Slider as SliderItem;
use yii\helpers\Html;

class Slider extends Widget
{
    public $template = 'slider';
    public $templateSlide = '_content';
    public $showIndicators = true;
    public $containerOptions = [
        'class'         => 'slide',
        'data-interval' => 8000,
        'id' => 'carousel',
    ];
    public $options = [];
    public $controls = null;
    public $id = 0;
    /**
     * Fixed height and images as background images
     * Add additonal css width fixed height:
     *
        .carousel-inner {
            height : x;
        }

        .carousel .item {
            height : 100%
        }

        .carousel .fill {
            width                   : 100%;
            height                  : 100%;
            background-position     : center;
            -webkit-background-size : cover;
            -moz-background-size    : cover;
            background-size         : cover;
            -o-background-size      : cover;
        }
     *
     */
    public $fixed = false;

    public function init()
    {
        parent::init();

        if ($this->controls === null) {
            $this->controls = [
                '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span>',
                '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span>',
            ];
        }
    }

    /**
     * @return null|string
     */
    public function run()
    {
        if ($this->id == null) {
            return null;
        }

        $slider = SliderItem::findOne($this->id);

        $items = [];

        $images = $slider->getImages(['active' => 1]);

        if (count($images) <= 1) {
            $this->controls = false;
            $this->showIndicators = false;
        }

        foreach ($images as $image) {
            $items[] = [
                'content'     => $this->render($this->templateSlide, ['image' => $image, 'slider' => $slider, 'fixed' => $this->fixed]),
                'options'     => $this->options,
            ];
        }

        return $this->render($this->template, ['items' => $items, 'controls' => $this->controls, 'showIndicators' => $this->showIndicators, 'containerOptions' => $this->containerOptions]);
    }
}
