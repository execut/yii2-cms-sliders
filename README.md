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


Once the extension is installed, simply modify your backend configuration as follows:

```php
return [
    ...
    'modules' => [
        ...
        'yii2images' => [
           'class' => 'rico\yii2images\Module',
           'imagesStorePath' => 'img/store', //path to origin images
           'imagesCachePath' => 'img/cache', //path to resized copies
           'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
           'placeHolderPath' => '@infoweb/sliders/img/placeHolder.png',
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
