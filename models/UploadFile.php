<?php

namespace app\models;

use Yii;
use yii\base\Model;

class UploadFile extends Model
{
    public $file;

    public function rules(){
        return [
            [['file'],'required'],
        ];
    }

    public function attributeLabels(){
        return [
            'file'=>'Select File',
        ];
    }

    public static function UploadedFile($File,$path)
    {
        $filename = $File['name'];
        $path     = $path.$filename;
        if (move_uploaded_file($File['tmp_name'], $path))
        {
            return true;
        } else {
            return false;
        }

    }
}

?>