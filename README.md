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

In file `web.php`
```
    <?php 
	....
	'modules' => [
		'class'=>'lawiet\rbac\Module',
		'excludes'=>[
			'modules' => ['rbac'], //List id Modules to RBAC exclude 
			//'controllers' => ['rbac.default'], //List id controllers to RBAC exclude module.controller
			//'actions' => ['rbac.default.index'], //List id action to RBAC exclude module.controller.action
		],
		'menu'=>[
			'icon'=>true, // boolean show icon true or false. Default: true
		],
	],
	...
    ?>
```

In file `assets/AppAsset.php` change yii\web\AssetBundle for lawiet\rbac\web\AssetBundle
```
    <?php 
	....
	use lawiet\rbac\web\AssetBundle;

	class AppAsset extends AssetBundle {
	...
    ?>
```

In each file `controllers/xxxController.php` change yii\web\Controller for lawiet\rbac\web\Controller
```
    <?php 
	....
	use lawiet\rbac\web\Controller;

	class xxxController extends Controller {
	...
    ?>
```

And remove method behaviors or modify and add the method parent
```
    <?php 
	....
	class xxxController extends Controller {
	....
	public function behaviors()
	{
		return parent::behaviors();
	}
	...
    ?>
```
