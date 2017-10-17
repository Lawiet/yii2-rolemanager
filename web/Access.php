<?php

namespace lawiet\rbac\web;

use Yii;
use yii\web\Controller;

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
        $guest = \Yii::$app->user->isGuest;

		if(method_exists($user, 'getIdRols') && method_exists($user, 'getIdAssignments')){
			return true;
		}

		return false;

        if (method_exists($user, 'getIsAdmin')) {
            return $user->getIsAdmin();
        } else if ($this->adminPermission) {
            return $this->adminPermission ? \Yii::$app->user->can($this->adminPermission) : false;
        } else {
            return isset($user->username) ? in_array($user->username, $this->admins) : false;
        }
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
