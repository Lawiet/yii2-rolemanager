<?php
namespace lawiet\rbac;

use Yii;
use yii\helpers\Inflector;
use yii\filters\AccessControl;

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
     * @inheritdoc 
     */ 
    public $excludes;
	
    /** 
     * @inheritdoc 
     */ 
    public $menu;

    /** 
     * @inheritdoc 
     */ 
    public function init() 
    {
        parent::init();
    }
}
