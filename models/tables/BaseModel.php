<?php

namespace app\models\tables;

use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord
{

    public $path = '/images/icons/';
    public $file = 'no-image.jpg';

    public function formName()
    {
        return '';
    }

    /**
     * Возвращает путь к иконке, в случае пустых данных
     * @param type $file
     * @return string
     */
    public function imageUrl($model = null, $path = null, $file = null)
    {
        $root = \Yii::getAlias('@webroot');
        $q = $q = $this->path . $this->file;
                
        if ($model and $model->imagePath and $model->image) {
            $q = $model->imagePath . $model->image;
        }
        
        if ($path and $file) {
            $q = $path . $file;
        }
        
        if ($this->imagePath and $this->image) {
            $q = $this->imagePath . $this->image;
        }
        
        $root . $q;
        
        if (file_exists($root)) {
            return $q;
        } else {
            return $this->path . $this->file;
        }
    }

}
