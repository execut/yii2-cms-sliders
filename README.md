Sliders module for Yii 2
========================

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
