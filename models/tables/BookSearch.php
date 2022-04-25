<?php

namespace app\models\tables;

class BookSearch extends Book
{

    public $searchText; // часть поисковго текста из параметров запроса
    public $genreIds; // ids из параметров запроса
    public $authorIds; // ids из параметров запроса

    public function rules()
    {
        return [
            [['searchText', 'genreIds', 'authorIds'], 'safe'],
        ];
    }

    public function search($params)
    {
        $this->load($params);

        $query = Book::find()
                ->select('book.*, '
                        . 'GROUP_CONCAT(DISTINCT `genre`.genre_name ORDER BY `book_genre`.id SEPARATOR " / ") AS `genre_names`, '
                        . 'GROUP_CONCAT(DISTINCT `author`.author_name ORDER BY `book_author`.id) AS `autor_names`, '
                        . 'GROUP_CONCAT(DISTINCT `author`.author_surname ORDER BY `book_author`.id) AS `autor_surnames`, '
                        . 'GROUP_CONCAT(DISTINCT CONCAT_WS(" ", `author`.author_name, `author`.author_surname) ORDER BY `book_author`.id SEPARATOR " / ") AS `full_names` '
                )
                ->leftJoin('book_genre', 'book_genre.book_id = book.id')
                ->leftJoin('genre', 'genre.id = book_genre.genre_id')
                ->leftJoin('book_author', 'book_author.book_id = book.id')
                ->leftJoin('author', 'author.id = book_author.author_id')
                ->andFilterWhere(['in', 'genre.id', $this->genreIds])
                ->andFilterWhere(['in', 'author.id', $this->authorIds])
                ->groupBy('book.id')
        ;

        if ($this->searchText) {
            $query->andWhere('MATCH (book.book_name) AGAINST (:text IN BOOLEAN MODE)', [':text' => $this->searchText . '*']);
        }
        return $query;
    }

    public function getGenreList()
    {
        $list = Genre::find()->asArray()->all();
        return $list;
    }

    public function getAuthorList()
    {
        $list = Author::find()->asArray()->all();
        return $list;
    }

//        $text = 'Войн';
//        $genre = '2';
//        $author = '3';
//        $params = [];
//
//        $select = 'SELECT book.*, genre.genre_name, author.author_name, author.author_surname, '
//                . 'GROUP_CONCAT(DISTINCT genre_id ORDER BY book_genre.id) AS genreIds, '
//                . 'GROUP_CONCAT(DISTINCT author_id ORDER BY book_author.id) AS autorIds '
//                . 'FROM book '
//                . 'LEFT JOIN book_genre ON book_genre.book_id = book.id '
//                . 'LEFT JOIN genre ON genre.id = book_genre.genre_id '
//                . 'LEFT JOIN book_author ON book_author.book_id = book.id '
//                . 'LEFT JOIN author ON author.id = book_author.author_id '
//                . 'WHERE MATCH (book.book_name) AGAINST ("Войн*" IN BOOLEAN MODE) OR genre.id IN (3) OR author.id IN (3)';
//
//        $select .= 'GROUP BY book.id';
//
//        $books = Yii::$app->db->createCommand($select, $params)
//                ->queryAll();
}
