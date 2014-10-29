<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use infoweb\sliders\SliderAsset;
use yii\helpers\Url;

SliderAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel infoweb\sliders\models\SearchSlider */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('infoweb/sliders', 'Sliders');
$this->params['breadcrumbs'][] = $this->title;

// Render growl messages
$this->render('_growl_messages');

?>

<div class="slider-index">

    <?php // Title ?>
    <h1>
        <?= Html::encode($this->title) ?>
        <?php // Buttons ?>
        <div class="pull-right">
            <?= Html::a(Yii::t('app', 'Create {modelClass}', [
                'modelClass' => Yii::t('infoweb/sliders', 'Slider'),
            ]), ['create'], ['class' => 'btn btn-success']) ?>
    
            <?= Html::button(Yii::t('app', 'Delete'), [
                'class' => 'btn btn-danger',
                //'disabled' => 'true',
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
                'class' => '\kartik\grid\CheckboxColumn',
                'options' => ['class' => 'test']
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->name), Url::toRoute([
                        'update', 'id' => $model->id
                    ]), [
                        'title' => Yii::t('app', 'Update'),
                        'data-pjax' => '0',
                        'data-toggle' => 'tooltip',
                        'class' => 'edit-model',
                    ]);
                },
            ],
            'width',
            'height',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete} {images}',
                'buttons' => [
                    'images' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-picture"></span>', $url, [
                            'title' => Yii::t('infoweb/sliders', 'Images'),
                            'data-pjax' => '0',
                            'data-toggle' => 'tooltip',
                        ]);
                    },
                ],
                'urlCreator' => function($action, $model, $key, $index) {

                    if ($action == 'images')
                    {
                        $params = is_array($key) ? $key : ['sliderId' => (int) $key];
                        $params[0] = $action . '/index';
                    } else {
                        $params = is_array($key) ? $key : ['id' => (int) $key];
                        $params[0] = 'default' . '/' . $action;
                    }

                    return Url::toRoute($params);
                },
                'updateOptions' => ['title' => Yii::t('app', 'Update'), 'data-toggle' => 'tooltip'],
                'deleteOptions' => ['title' => Yii::t('app', 'Delete'), 'data-toggle' => 'tooltip'],
                'width' => '100px',
            ],
        ],
        'responsive' => true,
        'floatHeader' => true,
        'floatHeaderOptions' => ['scrollingTop' => 88],
        'hover' => true,
    ]); ?>
    <?php Pjax::end(); ?>

</div>
