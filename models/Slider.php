<?php

namespace infoweb\sliders\models;

use infoweb\cms\models\Image;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "slider".
 *
 * @property string $id
 * @property string $name
 * @property string $width
 * @property string $height
 * @property string $created_at
 * @property string $updated_at
 */
class Slider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * Behaviors
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'infoweb\cms\behaviors\ImageBehave',
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => function () {
                    return time();
                },
            ],
        ];
    }

    /**
     * Get the popup image for images gridview
     *
     * @return string
     */
    public function getPopupImage($id = null)
    {
        $image = Image::findOne($id);
        return '<a class="fancybox" data-pjax="0" rel="fancybox" href="' . $image->getUrl("{$this->width}x{$this->height}") . '"><img src="' . $image->getUrl('80x80') . '" /></a>';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'width', 'height'], 'required'],
            [['width', 'height', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['width', 'height'], 'default', 'value' => 0]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('infoweb/cms', 'Name'),
            'width' => Yii::t('infoweb/sliders', 'Width'),
            'height' => Yii::t('infoweb/sliders', 'Height'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
