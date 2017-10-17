<?php

namespace lawiet\rbac\web;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use kartik\icons\Icon;
use lawiet\rbac\models\PermissionRole;
use lawiet\rbac\models\Permission;

/**
 * Default controller for the `lawiet` module
 */
class Breadcrumbs extends Controller
{

    /**
     * Get item Leteral Menu from user autenticated or guest.
     *
     * @var $icon. Default true
     *
     * @return array
     */
    public function getBreadcrumbs($icon = true)
    {
        $user = \Yii::$app->user->identity;
        $guest = \Yii::$app->user->isGuest;

		return [];
    }
}
