
<?= \yii\bootstrap\Carousel::widget([
    'items' => $items,
    'controls' => $controls,
    'showIndicators' => $showIndicators,
    'options' => ['class' => 'slide', 'data-interval' => 8000],
]); ?>
