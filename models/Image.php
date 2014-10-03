<?php
namespace infoweb\sliders\models;

use rico\yii2images\models\Image as BaseImage;
use dosamigos\translateable\TranslateableBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class Image extends BaseImage
{

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'trans' => [
                'class' => TranslateableBehavior::className(),
                'translationAttributes' => [
                    'alt',
                    'title',
                    'description',
                ]
            ],
        ]);
    }

    /*
    public function getUrl($size = false){
        $urlSize = ($size) ? '_'.$size : '';
        $url = Url::toRoute([
            '/'.$this->getModule()->id.'/images/image-by-item-and-alias',
            'item' => $this->modelName.$this->itemId,
            'dirtyAlias' =>  $this->urlAlias.$urlSize.'.'.$this->getExtension()
        ]);

        return $url;
    }
    */

    public function getPath($size = false){
        $urlSize = ($size) ? '_'.$size : '';
        $base = $this->getModule()->getCachePath();
        $sub = $this->getSubDur();

        $origin = $this->getPathToOrigin();

        // Custom
        $filePath = $base.'/'.
            $sub.'/'.$this->urlAlias.$urlSize.'.'.pathinfo($origin, PATHINFO_EXTENSION);;

        if(!file_exists($filePath)){
            $this->createVersion($origin, $size);

            if(!file_exists($filePath)){
                throw new \Exception('Problem with image creating.');
            }
        }

        return $filePath;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['filePath', 'itemId', 'modelName', 'urlAlias'], 'required'],
            [['itemId', 'isMain'], 'integer'],
            [['filePath', 'urlAlias'], 'string', 'max' => 400],
            [['modelName'], 'string', 'max' => 150]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(ImageLang::className(), ['image_id' => 'id']);
    }

    public function getImage() {
        return '<a class="fancybox" data-pjax="0" rel="fancybox" href="' . \Yii::$app->request->baseUrl . '/' . $this->getPath('1000x') . '"><img src="' . \Yii::$app->request->baseUrl . '/' . $this->getPath('80x80') . '" /></a>';
    }
}