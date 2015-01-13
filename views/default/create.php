<?php

use yii\helpers\Html;
use infoweb\sliders\assets\SliderAsset;

SliderAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Slider */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('infoweb/sliders', 'Slider'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('infoweb/sliders', 'Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Render growl messages
$this->render('_growl_messages');

?>
<div class="slider-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
