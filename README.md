Sliders module for Yii 2
========================

Docs
-----
- [Installation images module](https://github.com/CostaRico/yii2-images)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist infoweb-internet-solutions/yii2-cms-sliders "*"
```

or add

```
"infoweb-internet-solutions/yii2-cms-sliders": "*"
```

to the require section of your `composer.json` file.


Add these aliases:

```
Yii::setAlias('uploads', 'http://' . $_SERVER['HTTP_HOST'] . '/www.vangompelrenette.be/frontend/web/uploads');
Yii::setAlias('uploadsBaseUrl', dirname(dirname(__DIR__)) . '/frontend/web/uploads');
```


Once the extension is installed, simply modify your common configuration as follows:

```php
return [
    ...
    'modules' => [
        ...
        'yii2images' => [
            'class' => 'rico\yii2images\Module',
            // @frontend/web/
            'imagesStorePath' => '@uploadsBaseUrl/img/store', //path to origin images
            'imagesCachePath' => '@uploadsBaseUrl/img/cache', //path to resized copies
            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
            'placeHolderPath' => '@infoweb/sliders/assets/img/placeHolder.png',
        ],
    ],
];
```

Create "img" folder in web root manually and set 777 permissions

Usage
-----

Once the extension is installed run this migration

```
yii migrate/up --migrationPath=@infoweb/sliders/migrations
```

and add this to your config

````
'sliders' => [
    'class' => 'infoweb\sliders\Module',
],
````
