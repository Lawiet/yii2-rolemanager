<?php

namespace lawiet\rbac\web;

use Yii;
use yii\web\Controller;
use lawiet\rbac\models\PermissionRole;
use lawiet\rbac\models\Permission;

/**
 * Default controller for the `lawiet` module
 */
class Access extends Controller
{

    /**
     * Checks access.
     *
     * @return bool
     */
    public static function checkAccess()
    {
        $user = \Yii::$app->user->identity;
        $module = \Yii::$app->controller->module->id;
        $controller = \Yii::$app->controller->id;
        $action = \Yii::$app->controller->action->id;
        $uric = '/' . $module . '/' . $controller;
        $uri = $uric . '/' . $action;
        $permission = $roles = [];
        $where = [
            'status'=>true,
        ];

        if(\Yii::$app->user->isGuest)
            return false;

		foreach($user->rolesUsers as $role)
            $roles[] = $role->id_rol;

        $permissionsRoles = PermissionRole::find()->where(['in', 'id_rol', $roles])->all();
        $permissions = Permission::find()->where(['in', 'id', $permissionsRoles])
                                ->andWhere(['uri'=> strtolower($action)=="index" ? $uric : $uri])
                                ->all();

        if(!$permissions)
            return false;

        foreach($permissions as $p){
            $permission[] = $p->id;

            if($p->status == false)
                return false;
        }

        $permissions = Permission::find()->where(['in', 'id', $permissionsRoles])
                                ->andWhere(['in', 'id_permission', $p])
                                ->andWhere($where)
                                ->all();

        if(!$permissions)
            return false;

        return true;
    }

    /**
     * Get item Principal Menu from user autenticated or guest.
     *
     * @var $icon. Default true
     * @var $dataLogout. Default username
     * @var $iconLogout. Default off
     * @var $option. Default ['class' => 'navbar-nav navbar-right']
     *
     * @return array
     */
    public static function getPrincipalMenu($icon = true, $dataLogout = "username", $iconLogout = "off", $option = ['class' => 'navbar-nav navbar-right'])
    {
        return PrincipalMenu::getPrincipalMenu($icon, $dataLogout, $iconLogout, $option);
    }

    /**
     * Get item Leteral Menu from user autenticated or guest.
     *
     * @var $icon. Default true
     *
     * @return array
     */
    public static function getLateralMenu($icon = true)
    {
        return LateralMenu::getLateralMenu($icon);
    }

    /**
     * Get item Leteral Menu from user autenticated or guest.
     *
     * @var $icon. Default true
     *
     * @return array
     */
    public static function getBreadcrumbs($icon = true)
    {
        return Breadcrumbs::getBreadcrumbs($icon);
    }
}
