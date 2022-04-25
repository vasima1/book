<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class MainController extends Controller
{
    public $url; // Параметры запроса, для удобства
    public $urlParams; // Get or POST params
    public $data; // Какаие то доп данные для видов

    protected function start($url = null)
    {
        $this->getUrlParams();

    }

    protected function getUrlParams()
    {
        $this->url = Yii::$app->request->pathInfo;
        
        if (Yii::$app->request->isGet) {
            $this->urlParams = Yii::$app->request->queryParams;
        } else {
            $this->urlParams = Yii::$app->request->bodyParams;
        }
    }

}
