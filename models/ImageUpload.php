<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\base\Model;

class ImageUpload extends Model
{
    public $image;

    public function uploadFile(UploadedFile $file, $currentImage)
    {
       $this->image=$file;
       if($this->validate()) {
           $this->deleteCurrentImage($currentImage);
           return $this->savaImage();
       }
    }

    public function savaImage(){
        $filename = $this->generationFilename();
        $this->image->saveAs($this->getFolder() . $filename);
        return $filename;
    }

    public function getFolder()
    {
        return Yii::getAlias('@webroot/uploads/');
    }

    public function generationFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' .$this->image->extension);
    }

    public function deleteCurrentImage($currentImage)
    {
        if($this->fileExist($currentImage)) {
                unlink($this->getFolder() . $currentImage);
        }
    }

    public function fileExist($currentImage)
    {
        if(!empty($currentImage) && $currentImage!=null) {
            return file_exists($this->getFolder() . $currentImage);
        }
    }


    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png']
        ];
    }


}
