Sliders module for Yii 2
========================

Docs
-----
- [Installation cms module](https://github.com/infoweb-internet-solutions/yii2-cms/blob/master/README.md)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
php composer.phar require --prefer-dist infoweb-internet-solutions/yii2-cms-sliders "*"
```

or add

```json
"infoweb-internet-solutions/yii2-cms-sliders": "*"
```

to the require section of your `composer.json` file.
  
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

Run this migration

```bash
yii migrate/up --migrationPath=@infoweb/sliders/migrations
```

Import the translations
```bash
yii i18n/import @infoweb/sliders/messages
```

Add to `backend/config/main.php`
````php
'modules' => [
	...
	'sliders' => [
    	'class' => 'infoweb\sliders\Module',
	],
	...
	'cms' => [
		...
		'sideBarItems'  => [
			'modules'   => [
				...
				[
					'label'     => 'Sliders',
					'i18nGroup' => 'infoweb/sliders',
					'url'       => '/sliders/slider/index',
					'authItem'  => 'showSlidersModule',
					'activeUrl' => 'sliders',
				],
			],
		],
	],
	...
],
````
