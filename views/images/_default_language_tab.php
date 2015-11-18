<div class="tab-content language-tab">
    <?= $form->field($model, "[{$model->language}]alt")->textInput([
        'maxlength' => 255,
        'name' => "ImageLang[{$model->language}][alt]",
    ]); ?>

    <?php if (Yii::$app->getModule('sliders')->enableImageTitle) : ?>
    <?= $form->field($model, "[{$model->language}]title")->textInput([
        'maxlength' => 255,
        'name' => "ImageLang[{$model->language}][title]"
    ]); ?>
    <?php endif; ?>

    <?php if (Yii::$app->getModule('sliders')->enableImageSubTitle) : ?>
    <?= $form->field($model, "[{$model->language}]subtitle")->textInput([
        'name' => "ImageLang[{$model->language}][subtitle]",
        'maxlength' => 255,
    ]) ?>
    <?php endif; ?>

    <?php if (Yii::$app->getModule('sliders')->enableImageDescription) : ?>
    <?= $form->field($model, "[{$model->language}]description")->textarea([
        'name' => "ImageLang[{$model->language}][description]",
        'rows' => 5,
    ]); ?>
    <?php endif; ?>

    <?php if (Yii::$app->getModule('sliders')->enableImageUrl) : ?>
    <?= $form->field($model, "[{$model->language}]link")->textInput([
        'name' => "ImageLang[{$model->language}][link]",
        'maxlength' => 255,
    ]) ?>
    <?php endif; ?>

</div>