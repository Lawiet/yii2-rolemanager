<?php
namespace lawiet\rbac;

use Yii;
use yii\helpers\Inflector;
use yii\filters\AccessControl;
use lawiet\rbac\assets\RbacAsset;

/**
 * module for rbac.
 *
 * @author Jorge Gonzalez
 * @email ljorgelgonzalez@outlook.com
 *
 * @since 1.0
 */

class Module extends yii\base\Module
{
    /** 
     * @inheritdoc 
     */ 
    public $controllerNamespace = 'lawiet\rbac\controllers'; 

    /**
     * @var array
     */
    public $admins = [];

	/**
     * @var string The Administrator permission name.
     */
    public $adminPermission;

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'         => true,
                        'roles'         => ['@'],
                        'matchCallback' => [$this, 'checkAccess'],
                    ]
                ],
            ],
        ];
    }
	/* */

    /** 
     * @inheritdoc 
     */ 
    public function init() 
    {
		//RbacAsset::register(Yii::$app->view);
		
        parent::init();
    }

    /**
     * Checks access.
     *
     * @return bool
     */
    public function checkAccess()
    {
        $user = \Yii::$app->user->identity;

        if (!method_exists($user, 'getIsAdmin')) {
            //return $user->getIsAdmin();
			return true;
        } else if ($this->adminPermission) {
            return $this->adminPermission ? \Yii::$app->user->can($this->adminPermission) : false;
        } else {
            return isset($user->username) ? in_array($user->username, $this->admins) : false;
        }
    }
}
