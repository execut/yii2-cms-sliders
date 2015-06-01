<?php
use yii\helpers\Html;
?>

<div id="carousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php foreach ($images as $k => $image) : ?>
            <li data-target="#carousel" data-slide-to="<?= $k ?>" <?= ($k == 0) ? 'class="active"' : '' ?>></li>
        <?php endforeach; ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php foreach ($images as $k => $image) : ?>
            <div class="item <?= ($k == 0) ? 'active' : '' ?>">
                <?= Html::img($image->getUrl("{$slider->width}x{$slider->height}"), ['class' => 'img-responsive pull-left', 'alt' => $image->alt, 'title' => $image->title]) ?>
                <div class="carousel-caption">
                    <?= $image->title ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
