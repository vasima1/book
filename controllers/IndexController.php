<?php

namespace app\controllers;

use Yii;
use app\models\tables\BookSearch;

class IndexController extends MainController
{

    public $layout = 'main';

    public function actionIndex()
    {
        $this->start();

        return $this->render('main', [
                    'bookModel' => new BookSearch(),
                        ]
        );
    }
    
    public function actionAjaxSearch()
    {
        $this->getUrlParams();
        
        $bookSearchModel = new BookSearch();
        $booksQuery = $bookSearchModel->search($this->urlParams);
        
        return $this->renderAjax('/list/books', [
                    'books' => $booksQuery->all()
                        ]
        );
    }

}
