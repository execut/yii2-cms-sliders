Sliders module for Yii 2
========================

Docs
-----
- [Installation admin module](https://github.com/mdmsoft/yii2-admin)
- [Installation user module](https://github.com/infoweb-internet-solutions/yii2-cms-user)
- [Installation migration utitlity](https://github.com/c006/yii2-migration-utility)

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
