<?php

namespace app\models\tables;

use Yii;

/**
 * This is the model class for table "genre".
 *
 * @property int $id
 * @property string $genre_name
 *
 * @property BookGenre[] $bookGenres
 */
class Genre extends \app\models\tables\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['genre_name'], 'required'],
            [['genre_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'genre_name' => 'Genre Name',
        ];
    }

    /**
     * Gets query for [[BookGenres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookGenres()
    {
        return $this->hasMany(BookGenre::className(), ['genre_id' => 'id']);
    }
}
