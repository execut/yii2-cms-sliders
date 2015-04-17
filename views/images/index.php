<?php

use yii\helpers\Html;
use kartik\widgets\FileInput;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use infoweb\cms\assets\ImageAsset;
use yii\helpers\Url;

ImageAsset::register($this);

/* @var $this yii\web\View */
/* @var $slider infoweb\sliders\models\Slider */

$this->title = Yii::t('infoweb/sliders', 'Images');
$this->params['breadcrumbs'][] = ['label' => Yii::t('infoweb/sliders', 'Sliders'), 'url' => ['slider/index']];
$this->params['breadcrumbs'][] = ['label' => $slider->name, 'url' => ['slider/update', 'id' => $slider->id]];
$this->params['breadcrumbs'][] = $this->title;

// Render growl messages
$this->render('_growl_messages');

?>

<div class="images-index">

    <h1><?= Yii::t('app', 'Add {modelClass}', ['modelClass' => strtolower(Yii::t('infoweb/sliders', 'Images'))] ) ?></h1>

    <?php $form = ActiveForm::begin(['action' => 'upload', 'options' => [ 'class' => 'image-upload-form', 'enctype' => 'multipart/form-data']]); ?>

    <?= Html::hiddenInput('sliderId', $slider->id) ?>

    <?php if ($slider->hasErrors()) { //it is necessary to see all the errors for all the files. @todo Show growl message
        echo '<pre>';
        print_r($slider->getErrors());
        echo '</pre>';
    } ?>

    <?= FileInput::widget([
        'name' => 'ImageUploadForm[images][]',
        'options' => [
            'multiple' => true,
            //'accept' => 'image/*',
        ],
        'pluginOptions' => [
            'previewFileType' => 'any',
            'mainClass' => 'input-group-lg',
        ],
    ]) ?>

    <?php ActiveForm::end(); ?>

    <?php // Title ?>
    <h1>
        <?= $this->title ?>
        <?php // Buttons ?>
        <div class="pull-right">
            <?= Html::a(Yii::t('app', 'Sort {modelClass}', [
                'modelClass' => Yii::t('infoweb/sliders', 'Images'),
            ]), ['sort?sliderId=' . $slider->id], ['class' => 'btn btn-success']) ?>
    
            <?= Html::button(Yii::t('app', 'Delete'), [
                'class' => 'btn btn-danger',
                'id' => 'batch-delete',
                'data-pjax' => 0,
                'style' => 'display: none;'
            ]) ?>    
        </div>
    </h1>

    <?php // Gridview ?>
    <?php Pjax::begin([
        'id'=>'grid-pjax'
    ]); ?>
    <?= GridView::widget([
        'id' => 'gridview',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => '\kartik\grid\CheckboxColumn'
            ],
            [
                'format' => 'raw',
                'label' => Yii::t('app', 'Image'),
                'hAlign' => GridView::ALIGN_CENTER,
                'value' => function($data) { return $data->popupImage; },
                'width' => '96px',

            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => Yii::t('app', 'Name'),
                'value' => function($data) { return $data->name; },
                'vAlign' => GridView::ALIGN_MIDDLE,
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function($action, $model, $key, $index) {

                    $params = is_array($key) ? $key : ['id' => (int) $key, 'sliderId' => Yii::$app->request->get('sliderId')];
                    $params[0] = $action;


                    return Url::toRoute($params);
                },
                'updateOptions'=>['title' => Yii::t('app', 'Update'), 'data-toggle' => 'tooltip'],
                'deleteOptions'=>['title' => Yii::t('app', 'Delete'), 'data-toggle' => 'tooltip'],
                'width' => '100px',
            ],
        ],
        'responsive' => true,
        'floatHeader' => true,
        'floatHeaderOptions' => ['scrollingTop' => 88],
        'hover' => true,
        'export' => false,
    ]) ?>
    <?php Pjax::end(); ?>

</div>
