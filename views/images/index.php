<?php

use yii\helpers\Html;
use kartik\widgets\FileInput;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use infoweb\sliders\ImageAsset;

ImageAsset::register($this);

/* @var $this yii\web\View */
/* @var $slider app\models\Slider */

$this->title = Yii::t('app', 'Images');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sliders'), 'url' => ['/sliders']];
$this->params['breadcrumbs'][] = ['label' => $slider->name, 'url' => ['/sliders/default/update', 'id' => $slider->id]];
$this->params['breadcrumbs'][] = $this->title;

// Render growl messages
$this->render('_growl_messages');

?>

<div class="images-index">

    <h1><?= Yii::t('app', 'Add {modelClass}', ['modelClass' => 'Images'] ) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if ($slider->hasErrors()) { //it is necessary to see all the errors for all the files. @todo Show growl message
        echo '<pre>';
        print_r($slider->getErrors());
        echo '</pre>';
    } ?>

    <?= FileInput::widget([
        'name' => 'UploadForm[images][]',
        'options' => [
            'multiple' => true,
            'accept' => 'image/*',
        ],
        'pluginOptions' => [
            'previewFileType' => 'any',
            'mainClass' => 'input-group-lg',
        ],
    ]) ?>

    <?php ActiveForm::end(); ?>

    <h1><?= $this->title ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Sort {modelClass}', [
            'modelClass' => 'Images',
        ]), ['sort?sliderId=' . $slider->id], ['class' => 'btn btn-success']) ?>

        <?= Html::button(Yii::t('app', 'Delete'), [
            'class' => 'btn btn-danger',
            'disabled' => 'true',
            'id' => 'batch-delete',
            'data-pjax' => 0,
        ]) ?>
    </p>

    <?php Pjax::begin([
        'id'=>'grid-pjax'
    ]); ?>
    <?= GridView::widget($gridView); ?>
    <?php Pjax::end(); ?>

</div>
