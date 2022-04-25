<?php

namespace app\models\tables;

use Yii;
use app\models\tables\BaseModel;
/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $book_name
 * @property string|null $image
 * @property string|null $description
 *
 * @property BookAuthor[] $bookAuthors
 * @property BookGenre[] $bookGenres
 */
class Book extends BaseModel
{
    public $imagePath = '/images/books/';
    public $genre_names; // 
    public $autor_names; // 
    public $autor_surnames; // 
    public $full_names; // Имя Фамилия 

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_name'], 'required'],
            [['description'], 'string'],
            [['book_name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_name' => 'Book Name',
            'image' => 'Image',
            'description' => 'Description',
            'searchText' => 'Поиск по названию',
            'genreIds' => 'Жанры',
            'authorIds' => 'Авторы',
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::className(), ['book_id' => 'id']);
    }

    /**
     * Gets query for [[BookGenres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookGenres()
    {
        return $this->hasMany(BookGenre::className(), ['book_id' => 'id']);
    }
}
