<?php

namespace lawiet\rbac\web;

use Yii;
use yii\web\Controller;
use lawiet\rbac\models\Assignment;
use lawiet\rbac\models\Permission;
use lawiet\rbac\models\PermissionRole;

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
        $uri = '/' . $module . '/' . $controller;
        $permissions = $roles = [];
        $where = [
            'status'=>true,
        ];

        if(\Yii::$app->user->isGuest)
            return false;

		foreach($user->rolesUsers as $role)
            $roles[] = $role->id_rol;

        $permissions = Permission::find()
                                 ->joinWith(['permissionsRoles'])
                                 ->where(['in', 'permission_role.id_rol', $roles])
                                 ->andWhere(['uri'=>$uri])
                                 ->one();

        if(!$permissions)
            return false;

        if($permissions->id_permission > 0){
            $ppermissions = Permission::find()
                                     ->joinWith(['permissionsRoles'])
                                     ->where(['in', 'permission_role.id_rol', $roles])
                                     ->andWhere(['Permission.id'=>$permissions->id_permission])
                                     ->one();

            if(!$ppermissions)
                return false;

            if($ppermissions->id_permission > 0){
                $pppermissions = Permission::find()
                                         ->joinWith(['permissionsRoles'])
                                         ->where(['in', 'permission_role.id_rol', $roles])
                                         ->andWhere(['Permission.id'=>$ppermissions->id_permission])
                                         ->one();

                if(!$pppermissions)
                    return false;
            }
        }

        $assignments = Assignment::find()
                                 ->joinWith(['assignmentsUsers'])
                                 ->where(['in', 'assignment_user.id_user', $user->id])
                                 ->andWhere(['in', 'id_permission', $permissions->id])
                                 ->andWhere([
                                    'status'=>true,
                                    'method'=>strtoupper($action),
                                ])
                                ->all();

        if(!$assignments)
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
