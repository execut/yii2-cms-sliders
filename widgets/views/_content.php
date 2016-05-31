<?php
use yii\helpers\Html;
?>
<style>
    .carousel-inner { height: <?= (int) $slider->height;?>px; }
</style>
<?php if ($fixed): ?>
<div class="fill" style="background-image:url(<?= $image->getUrl("{$slider->width}x{$slider->height}") ?>);"></div>
<?php else: ?>
<?= Html::img($image->getUrl("{$slider->width}x{$slider->height}"), ['alt' => $image->alt, 'title' => $image->title]) ?>
<?php endif; ?>

<?php if ($image->link): ?>
<div class="content">
    <div class="title">
        <?= $image->title ?>
    </div>
    <div class="description">
        &quot;<?= $image->description ?>&quot;
    </div>
    <?= Html::a(Yii::t('frontend', 'More info'), $image->link, ['class' => 'btn btn-default']) ?>
</div>
<?php endif; ?>
