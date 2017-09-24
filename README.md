Yii2 Role Manager
==================
Component to use Role Manager with Yii2


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require lawiet/yii2-rolemanager "dev-master"
```

or add

```
"minimum-stability": "dev",
"prefer-stable": true,
require: {
...
    "lawiet/yii2-rolemanager": "@dev"
...
}
```

to the require section of your `composer.json` file.


Role configuration
--------------------

In file web.php
```
    <?php 
	....
	'modules' => [
        'rbac' => 'lawiet\rbac\Module',
	],
    ...
    ?>
```

In file assets/AppAsset.php change yii\web\AssetBundle for lawiet\rbac\assets\RbacAsset
```
    <?php 
	....
	use lawiet\rbac\assets\RbacAsset as AssetBundle;

	class AppAsset extends AssetBundle
    ...
    ?>
```
