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

Configuration
-------------
All available configuration options are listed below with their default values.
___
##### defaultWith (type: `integer`, default: `800`)
The default with (in pixels) of a new slider.
___
##### defaultHeight (type: `integer`, default: `200`)
The default height (in pixels) of a new slider.
___
##### enableImageTitle (type: `boolean`, default: `false`)
If this option is set to `true`, it is possible to set a title for each image of a slider.
___
##### enableImageSubTitle (type: `boolean`, default: `false`)
If this option is set to `true`, it is possible to set a subtitle for each image of a slider.
___
##### enableImageDescription (type: `boolean`, default: `false`)
If this option is set to `true`, it is possible to set a description for each image of a slider.
___
##### enableImageUrl (type: `boolean`, default: `false`)
If this option is set to `true`, it is possible to set an url for each image of a slider.
___
##### enableTextPosition (type: `boolean`, default: `false`)
If this option is set to `true`, it is possible to set a position for each image text in the a slider.
___