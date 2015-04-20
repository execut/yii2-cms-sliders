<div class="tab-content language-tab">
    <?= $form->field($model, "[{$model->language}]alt")->textInput([
        'maxlength' => 255,
        'name' => "ImageLang[{$model->language}][alt]",
    ]); ?>

    <?= $form->field($model, "[{$model->language}]title")->textInput([
        'maxlength' => 255,
        'name' => "ImageLang[{$model->language}][title]"
    ]); ?>

    <?= $form->field($model, "[{$model->language}]subtitle")->textInput([
        'name' => "ImageLang[{$model->language}][subtitle]",
        'maxlength' => 255,
    ]) ?>

    <?= $form->field($model, "[{$model->language}]description")->textarea([
        'name' => "ImageLang[{$model->language}][description]",
        'rows' => 5,
    ]); ?>

    <?= $form->field($model, "[{$model->language}]url")->textInput([
        'name' => "ImageLang[{$model->language}][url]",
        'maxlength' => 255,
    ]) ?>

</div>