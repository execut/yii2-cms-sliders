<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\TouchSpin;
use kartik\widgets\Growl;

/* @var $this yii\web\View */
/* @var $model app\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin([
        'id' => 'slider-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'name')->textInput([
        'maxlength' => 255,
        'tabindex' => 1,
        'autofocus' => true,
    ]) ?>

    <?= $form->field($model, 'width')->widget(TouchSpin::classname(), [
        'options' => [
            'maxlength' => 5,
            'tabindex' => 2,
        ],
        'pluginOptions' => [
            'min' => 0,
            'max' => 99999,
            'step' => 1,
            'postfix' => 'px'
        ],
    ]); ?>

    <?= $form->field($model, 'height')->widget(TouchSpin::classname(), [
        'options' => [
            'maxlength' => 5,
            'tabindex' => 3,
        ],
        'pluginOptions' => [
            'min' => 0,
            'max' => 99999,
            'step' => 1,
            'postfix' => 'px'
        ],
    ]); ?>

    <div class="buttons form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'tabindex' => 4,
        ]) ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create & close') : Yii::t('app', 'Update & close'), [
            'class' => 'btn btn-default',
            'name' => 'close', 'tabindex' => 5,
        ]) ?>
        <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Create & new' : 'Update & new'), [
            'class' => 'btn btn-default',
            'name' => 'new', 'tabindex' => 6,
        ]) ?>
        <?= Html::a(Yii::t('app', 'Close'), ['index'], [
            'class' => 'btn btn-danger',
            'tabindex' => 7,
        ]) ?>
    </div>

    <?php ActiveForm::end();  ?>

</div>
