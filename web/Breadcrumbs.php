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
    public function getBreadcrumbs($nombre = "", $id = "", $icon = true)
    {
        $user = \Yii::$app->user->identity;
        $guest = \Yii::$app->user->isGuest;
        $module = \Yii::$app->controller->module->id;
        $controller = \Yii::$app->controller->id;
        $action = \Yii::$app->controller->action->id;
        $uri = '/' . $module . '/' . $controller;

        $permissions = Permission::find()
            ->andWhere(['uri'=>$uri])
            ->one();

        $parent = $permissions;
        while($parent != null) {
            if($parent->permission != null) {
                $breadcrumbs[] = ['label' => Yii::t('app', $parent->name), 'url' => [$parent->uri]];
            } else {
                if($parent->name != "basic") {
                    $breadcrumbs[] = Yii::t('app', $parent->name);
                }
            }

            $parent = ($parent->permission == null) ? null : $parent->permission;
        }
        $breadcrumbs = array_reverse($breadcrumbs, true);

        if (!in_array($action, ["index", "view", "create"])) {
            $nombre = $nombre != "" ? Yii::t('app', $nombre) : Yii::t('app', 'view') . " " . Yii::t('app', $controller);

            if ($id != "") {
                $breadcrumbs[] = ['label' => $nombre, 'url' => ['view', 'id' => $id]];
            } else {
                $breadcrumbs[] = Yii::t('app', $nombre);
            }
        }

        $breadcrumbs[] = Yii::t('app', ucfirst($action));

        return $breadcrumbs;
    }
}
