<?php
/**
 * Created by brook
 * Date: 3/24/16 6:47 PM
 */

namespace backend\models;


use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model {

    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules() {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif, jpeg', 'maxSize' => 10 * 1024 * 1024],
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $uploadDir = '/uploads/';
            $uploadPath = \Yii::getAlias('@webroot' . $uploadDir);
            $sha1 = sha1_file($this->imageFile->tempName);
            $path = implode('/', str_split($sha1, 8)) . '.' . $this->imageFile->extension;
            $dir = $uploadPath . dirname($path);
            if(!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
//            $path = $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs( $uploadPath. $path);
            $url = $uploadDir. $path;
            return compact('path', 'url');
        }
        return false;
    }

}
