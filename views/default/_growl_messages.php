<?php

use kartik\widgets\Growl;

if (Yii::$app->session->hasFlash('slider-success'))
{
    echo Growl::widget([
        'type' => Growl::TYPE_SUCCESS,
        'icon' => 'glyphicon glyphicon-ok-sign',
        'body' => Yii::$app->session->getFlash('slider-success'),
    ]);
}
