<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model infoweb\sliders\models\Image */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="image-form">
    <?php
    // Init the form
    $form = ActiveForm::begin([
        'id' => 'page-image-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ]);

    // Initialize the tabs
    $tabs = [
        [
            'label' => Yii::t('app', 'General'),
            'content' => $this->render('_default_tab', ['model' => $model, 'form' => $form]),
        ],
        [
            'label'     => Yii::t('app', 'Data'),
            'content'   => $this->render('_data_tab', ['model' => $model,'form' => $form, 'slider' => $slider]),
        ],
    ];
    
    // Display the tabs
    echo Tabs::widget(['items' => $tabs]);
    ?>
    <div class="buttons form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Close'), ['index', 'sliderId' => $slider->id], ['class' => 'btn btn-danger']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
