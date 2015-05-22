<?php
use yii\helpers\Html;
use kartik\widgets\SwitchInput;
?>
<div class="tab-content default-tab">

    <div class="form-group">
        <label class="control-label"><?= Yii::t('app', 'Example') ?></label>
        <a href="<?php echo $model->getUrl("{$slider->width}x{$slider->height}"); ?>" class="fancybox">
            <img class="img-responsive thumbnail" src="<?php echo $model->getUrl('350x'); ?>">    
        </a>    
    </div>
    
    <?= $form->field($model, 'active')->widget(SwitchInput::classname(), [
        'pluginOptions' => [
            'onColor' => 'success',
            'offColor' => 'danger',
            'onText' => Yii::t('app', 'Yes'),
            'offText' => Yii::t('app', 'No'),
        ]
    ]) ?>
</div>