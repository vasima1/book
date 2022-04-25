<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$authorList = []; // Костылек на обьеденение полей "имя и фамилия"

foreach ($model->authorList as $key => $value) {
    $value['full_name'] = $value['author_name'] . ' ' . $value['author_surname'];
    $authorList[] = $value;
}
?>
<div class="forms-bookSearch w-100 mb-4">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'searchText') ?>
    
    <div id="genreIds-bl">
        <div class="spoiler toggle" title="Раскройте спойлер">Фильтр по жанрам</div>
        <div class="checkbox-bl none">
            <?= $form->field($model, 'genreIds')->checkboxList(ArrayHelper::map($model->genreList, 'id', 'genre_name'), ['placeholder' => 'Поиск по названию']) ?>
        </div>
    </div>
    <div id="authorIds-bl">
        <div class="spoiler toggle" title="Раскройте спойлер">Фильтр по авторам</div>
        <div class="checkbox-bl none">
            <?= $form->field($model, 'authorIds')->checkboxList(ArrayHelper::map($authorList, 'id', 'full_name'), []) ?>
        </div>
    </div>
    
    <?= Html::hiddenInput('action', '/index/ajax-search'); ?>
    
        <div class="form-group row">
            <?= Html::submitButton('Поиск', ['id' => 'search-form-start', 'class' => 'btn btn-primary mx-auto']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- forms-bookSearch -->
