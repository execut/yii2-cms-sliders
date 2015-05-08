<?php
use yii\helpers\Html;
?>
<?php foreach ($images as $image) : ?>
<?= Html::img($image->getUrl("{$slider->width}x{$slider->height}"), ['class' => 'img-responsive pull-left', 'alt' => $image->alt, 'title' => $image->title, 'subtitle' => $image->subtitle]) ?>
<?php endforeach; ?>
