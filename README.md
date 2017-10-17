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
    'user' => [
        'identityClass' => 'lawiet\rbac\models\User',
        'enableAutoLogin' => true,
        //'authTimeout' => 30,
    ],
	....
	'modules' => [
		'rbac' => [
			'class'=>'lawiet\rbac\Module',
			'excludes'=>[
				//'modules' => ['test'], //List id Modules to RBAC exclude
				//'controllers' => ['test.default'], //List id controllers to RBAC exclude module.controller
				//'actions' => ['test.default.index'], //List id action to RBAC exclude module.controller.action
			],
			'menu'=>[
				'icon'=>true, // boolean show icon true or false. Default: true
			],
		],
	],
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

Generate principal menu dynamically in your layout add
```
    <?php
	....
	use lawiet\rbac\web\Access;

	....
	NavBar::begin([
		'brandLabel' => Yii::t('app', 'My Company'),
		'brandUrl' => Yii::$app->homeUrl,
		'options' => [
			'class' => 'navbar-inverse navbar-fixed-top',
		],
	]);
	echo Nav::widget(Access::getPrincipalMenu());
	NavBar::end();
	...
    ?>
```

Run command
```
php yii migrate  --migrationPath=@lawiet/rbac/migrations --interactive=0
```
