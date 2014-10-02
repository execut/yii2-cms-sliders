<?php
use yii\helpers\Html;
use infoweb\sliders\ImageAsset;

ImageAsset::register($this);

/* @var $this yii\web\View */
/* @var $model infoweb\sliders\models\Image */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Image',
    ]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sliders'), 'url' => ['/sliders']];
$this->params['breadcrumbs'][] = ['label' => $slider->name, 'url' => ['/sliders/default/update', 'id' => $slider->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Images'), 'url' => ['index', 'sliderId' => $slider->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="image-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'slider' => $slider,
    ]) ?>
</div>