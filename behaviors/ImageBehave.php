<?php
/**
 * Created by PhpStorm.
 * User: kostanevazno
 * Date: 22.06.14
 * Time: 16:58
 */

namespace infoweb\sliders\behaviors;

use rico\yii2images\models\Image;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use rico\yii2images\models;
use yii\helpers\BaseFileHelper;
use rico\yii2images\ModuleTrait;
use yii\db\Query;

class ImageBehave extends \rico\yii2images\behaviors\ImageBehave
{
    /**
     *
     * Method copies image file to module store and creates db record.
     *
     * @param $absolutePath
     * @param bool $isFirst
     * @return bool|Image
     * @throws \Exception
     */
    public function attachImage($absolutePath, $isMain = false)
    {
        if(!preg_match('#http#', $absolutePath)){
            if (!file_exists($absolutePath)) {
                throw new \Exception('File not exist! :'.$absolutePath);
            }
        }else{
            //nothing
        }

        if (!$this->owner->id) {
            throw new \Exception('Owner must have id when you attach image!');
        }

        // Custom
        $pictureFileName = basename($absolutePath);

        $pictureSubDir = $this->getModule()->getModelSubDir($this->owner);
        $storePath = $this->getModule()->getStorePath($this->owner);

        $newAbsolutePath = $storePath .
            DIRECTORY_SEPARATOR . $pictureSubDir .
            DIRECTORY_SEPARATOR . $pictureFileName;

        BaseFileHelper::createDirectory($storePath . DIRECTORY_SEPARATOR . $pictureSubDir,
            0775, true);

        copy($absolutePath, $newAbsolutePath);

        if (!file_exists($absolutePath)) {
            throw new \Exception('Cant copy file! ' . $absolutePath . ' to ' . $newAbsolutePath);
        }

        if($this->modelClass === null) {
            $image = new models\Image;
        }else{
            $image = new ${$this->modelClass}();
        }
        $image->itemId = $this->owner->id;
        $image->filePath = $pictureSubDir . '/' . $pictureFileName;
        $image->modelName = $this->getModule()->getShortClass($this->owner);

        // Custom
        $image->urlAlias = $this->getAlias($pictureFileName);

        // Custom
        $query = new Query;
        $position = $query->select('`position`')
            ->from(Image::tableName())
            ->where("`modelName` = 'Slider'")->max('position');

        $image->position = $position + 1;
        $name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $pictureFileName);
        $image->name = $name;

        if(!$image->save()){
            return false;
        }

        if (count($image->getErrors()) > 0) {

            $ar = array_shift($image->getErrors());

            unlink($newAbsolutePath);
            throw new \Exception(array_shift($ar));
        }
        $img = $this->owner->getImage();

        //If main image not exists
        if(
            is_object($img) && get_class($img)=='rico\yii2images\models\PlaceHolder'
            or
            $img == null
            or
            $isMain
        ){
            $this->setMainImage($image);
        }


        return $image;
    }

    /**
     *
     * Обновить алиасы для картинок
     * Зачистить кэш
     */
    private function getAlias($pictureFileName)
    {
        $imagesCount = count($this->owner->getImages());

        // Custom
        // Remove extension
        $pictureFileName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $pictureFileName);
        return strtolower(trim(preg_replace('/[^a-zA-Z0-9\-]+/', '-', $pictureFileName), '-')) . '-' . intval($imagesCount + 1);
    }




}


