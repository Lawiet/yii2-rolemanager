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
class PrincipalMenu extends Controller
{

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
    public function getPrincipalMenu($icon = true, $dataLogout = "username", $iconLogout = "off", $option = ['class' => 'navbar-nav navbar-right'])
    {
        $user = \Yii::$app->user->identity;
        $guest = \Yii::$app->user->isGuest;

		if(trim($dataLogout) != "")
			eval('$dataLogout = !$guest ? " (" . $user->' . $dataLogout . ' . ")" : "" ;');

		$home = ['label' => Yii::t('app', 'Home'), 'url' => '/', 'icon' => 'home'];
		$login = ['label' => Yii::t('app', 'Login'), 'url' => '/site/login', 'icon' => 'sign-in'];
		$logout = ['label' => Yii::t('app', 'Logout') . $dataLogout, 'url' => '/site/logout', 'icon' => $iconLogout, 'method' => 'post'];

		$items = self::generatePrincipalMenu($guest, $icon);
		array_unshift($items, self::parserPrincipalMenu($home, $icon));
		$items[] = self::parserPrincipalMenu(Yii::$app->user->isGuest ? $login : $logout, $icon);

		return [
				'options' => $option,
				'encodeLabels' => false,
				'items' => $items,
			];
    }

	/*
	 * Get Items from database
	 *
	 * @var $guest. Default true
	 * @var $icon. Default true
     *
     * @return array
	 */
	private function generatePrincipalMenu($guest = true, $icon = true){
		$i = $items = [];
        $permissionsRoles = [];
        $permissions = Permission::find();

		if(!$guest){
            $roles = [];
			foreach(\Yii::$app->user->identity->roleUsers as $role)
                $roles[] = $role->id_role;

            $permissions = $permissions->joinWith(['permissionRoles'])
                                       ->where(['in', 'permission_role.id_rol', $roles]);
            $where = [
                'Permission.id_permission'=>null,
                'show_in_menu'=>true,
                'status'=>true,
            ];

		}else{
            $where = [
                'Permission.id_permission'=>null,
                'show_in_menu'=>true,
                'status'=>true,
                'logged'=>false,
            ];
		}

        $permissions = $permissions->andWhere($where)->all();
        if(count($permissions) > 0)
            foreach($permissions as $permission){
                $menu = [
                    'label' => Yii::t('app', $permission->name),
                    'url' => $permission->uri,
                    'icon' => $permission->icon,
                    'method' => $permission->data_method,
                    'items' => self::generatePrincipalSubMenu($permission, $roles, $guest, $icon),
                ];

                $items[] = $menu;
            }

		foreach($items as $item){
			$i[] = self::parserPrincipalMenu($item, $icon);
		}


		return $i;
	}

	/*
	 * Parser items to format NavBar
	 *
	 * @var Permission $permission
	 * @var $permissionsRoles. Default array
	 * @var $guest. Default true
	 * @var $icon. Default true
     *
     * @return array
	 */
	private function generatePrincipalSubMenu(Permission $permission, $roles = [], $guest = true, $icon = true){
		$i = $items = [];
        $permissions = Permission::find();

		if(!$guest){
            $permissions = $permissions->joinWith(['permissionRoles'])
                                       ->where(['in', 'permission_role.id_rol', $roles]);
            $where = [
                'Permission.id_permission'=>$permission->id,
                'show_in_menu'=>true,
                'status'=>true
            ];
		}else{
            $where = [
                'id_permission'=>$permission->id,
                'show_in_menu'=>true,
                'status'=>true,
                'logged'=>false
            ];
		}

        $permissions = $permissions->andWhere($where)->all();
        if(count($permissions) > 0)
            foreach($permissions as $permission){
                $menu = [
                    'label' => Yii::t('app', $permission->name),
                    'url' => $permission->uri,
                    'icon' => $permission->icon,
                    'method' => $permission->data_method,
                    'items' => self::generatePrincipalSubMenu($permission, $roles, $guest, $icon),
                ];

                $items[] = $menu;
            }

		foreach($items as $item){
			$i[] = self::parserPrincipalMenu($item, $icon);
		}

		return $i;
	}

	/*
	 * Parser items to format NavBar
	 *
	 * @var $link. Default ['label'=>'']
	 * @var $icon. Default true
     *
     * @return array
	 */
	private function parserPrincipalMenu($link = ['label'=>''], $icon = true){
		$label = isset($link['label']) ? $link['label'] : '&nbsp;' ;
		$url = isset($link['url']) ? Url::to([$link['url']]) : '#' ;

		if($icon && isset($link['icon'])){
            if(!empty($link['icon']))
                $label = Icon::show($link['icon']) . $label;
		}

		if(isset($link['method'])){
			if(strtolower($link['method']) == 'post'){
				$item = ['label' => $label, 'url' => $url, 'linkOptions' => ['data-method' => 'post']];
			}else{
				$item = ['label' => $label, 'url' => $url];
			}
		}else{
			$item = ['label' => $label, 'url' => $url];
		}

        if(isset($link['items']))
            if(count($link['items']) > 0)
                $item['items'] = $link['items'];

		return $item;
	}
}
