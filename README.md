Do not use this module! It's far from ready and it\'s not yet usefull

Simple sliders extension for Yii 2
==================================
This extension provides pages that can be added to a menu

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist infoweb/yii2-sliders "*"
```

or add

```
"infoweb/yii2-sliders": "*"
```

to the require section of your `composer.json` file.


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
