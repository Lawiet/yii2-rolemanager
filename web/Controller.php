<?php

namespace lawiet\rbac\web;

use yii\web\Controller as CController;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use lawiet\rbac\web\Access;

/**
 * Default controller for the `lawiet` module
 */
class Controller extends CController
{

    /**
     * @var array
     */
	private $listModulesExcludeByDefault = [''];

    /**
     * @var array
     */
	private $listControllersExcludeByDefault = [''];

    /**
     * @var array
     */
	private $listActionsExcludeByDefault = [''];

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
		if($this->isModuleExclude())
			return [
				'access' => [
					'class' => AccessControl::className(),
					'only' => ['logout'],
					'rules' => [
						[
							'actions' 		=> ['logout'],
							'allow'         => true,
							'roles'         => ['@'],
						]
					],
				],
				'verbs' => [
					'class' => VerbFilter::className(),
					'actions' => [
						'logout' => ['post'],
					],
				],
			];
		else
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

    /**
     * Checks access.
     *
     * @return bool
     */
    public function checkAccess()
    {
        return Access::checkAccess();
	}

    /**
     * Get name layout.
     *
     * @return String
     */
    public function getLayout()
    {
		return isset(\Yii::$app->modules['rbac']->layout) ? \Yii::$app->modules['rbac']->layout : 'main' ;
	}

    /**
     * Get Modules Exclude By Default And User.
     *
     * @return void
     */
    private function getExcludes()
    {
		$this->listModulesExcludeByDefault = array_merge($this->listModulesExcludeByDefault, [\Yii::$app->id]);
		$excludes = isset(\Yii::$app->modules['rbac']->excludes) ? \Yii::$app->modules['rbac']->excludes : (isset(\Yii::$app->modules['rbac']['excludes']) ? \Yii::$app->modules['rbac']['excludes'] : null ) ;

		if(isset($excludes['modules']) && is_array($excludes['modules']) && count($excludes['modules']) > 0){
			$this->listModulesExcludeByDefault = array_merge($excludes['modules'], $this->listModulesExcludeByDefault);
		}

		if(isset($excludes['controllers']) && is_array($excludes['controllers']) && count($excludes['controllers']) > 0){
			$this->listControllersExcludeByDefault = array_merge($excludes['modules'], $this->listControllersExcludeByDefault);
		}

		if(isset($excludes['actions']) && is_array($excludes['actions']) && count($excludes['actions']) > 0){
			$this->listActionsExcludeByDefault = array_merge($excludes['actions'], $this->listActionsExcludeByDefault);
		}
	}

    /**
     * Verify if current module controller and/or action is exclude.
     *
     * @return bool
     */
    private function isModuleExclude()
    {
		$this->getExcludes();
		$module = \Yii::$app->controller->module->id;
		$controller = \Yii::$app->controller->id;
		$action = \Yii::$app->controller->action->id;

		if(in_array('*', $this->listModulesExcludeByDefault)){
			return true;
		}

		if(in_array($module, $this->listModulesExcludeByDefault)){
			return true;
		}

		if(in_array($module.'.'.$controller, $this->listControllersExcludeByDefault)){
			return true;
		}

		if(in_array($module.'.'.$controller.'.'.$action, $this->listActionsExcludeByDefault)){
			return true;
		}

		return false;
	}
}
