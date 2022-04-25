<?php
//debug($books);
?>
<?php foreach ($books as $key => $model) :?>

<div class="list-item-bl row p-3">
    <div class="item-image-bl">
        <img src="<?= $model->imageUrl()?>" alt="Изображение книги" width="200px" height="200px">
    </div>
    <div class="item-content-bl row p-3">
        <h5 class="w-100"><?= $model->book_name?></h5>
        <label class="w-100">Описание:</label>
        <div class="item-description w-100"><?= $model->description?></div>
        <label class="w-100">Жанры:</label>
        <div class="item-description w-100"><?= $model->genre_names?></div>
        <label class="w-100">Авторы:</label>
        <div class="item-description w-100"><?= $model->full_names?></div>
    </div>
</div>

<?php endforeach; ?>
