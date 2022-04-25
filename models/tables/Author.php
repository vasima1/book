<?php

namespace app\models\tables;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string|null $author_name
 * @property string|null $author_surname
 *
 * @property BookAuthor[] $bookAuthors
 */
class Author extends \app\models\tables\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_name', 'author_surname'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_name' => 'Author Name',
            'author_surname' => 'Author Surname',
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::className(), ['author_id' => 'id']);
    }
}
