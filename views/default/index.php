<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use infoweb\sliders\SliderAsset;

SliderAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchSlider */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sliders');
$this->params['breadcrumbs'][] = $this->title;

// Render growl messages
$this->render('_growl_messages');

?>

<div class="slider-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
            'modelClass' => 'Slider',
        ]), ['create'], ['class' => 'btn btn-success']) ?>

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
