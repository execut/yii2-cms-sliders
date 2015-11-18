<?php
use yii\helpers\Html;
?>
<?= Html::img($image->getUrl("{$slider->width}x{$slider->height}"), ['alt' => $image->alt, 'title' => $image->title]) ?>
<?php if ($image->title): ?>
<div class="content">
    <div class="title">
        <?= $image->title ?>
    </div>
    <div class="description">
        &quot;<?= $image->description ?>&quot;
    </div>
    <?= Html::a(Yii::t('frontend', 'More info'), $image->url, ['class' => 'btn btn-default']) ?>
</div>
<?php endif; ?>