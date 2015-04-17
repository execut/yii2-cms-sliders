<?php

use yii\helpers\Html;
use infoweb\sliders\assets\SliderAsset;

SliderAsset::register($this);

$this->title = Yii::t('app', 'Update {modelClass}', [
    'modelClass' => Yii::t('infoweb/sliders', 'Slider'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('infoweb/sliders', 'Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

// Render growl messages
$this->render('_growl_messages');

?>
<div class="slider-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
