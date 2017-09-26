<?php

namespace lawiet\rbac\web;

use Yii;
use yii\web\Controller as Controller;
use yii\helpers\Url;
use kartik\icons\Icon;

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
        $user = \Yii::$app->user->identity;
        $guest = \Yii::$app->user->isGuest;
		
		if(trim($dataLogout) != "")
			eval('$dataLogout = !$guest ? " (" . $user->' . $dataLogout . ' . ")" : "" ;');
		
		$home = ['label' => Yii::t('app', 'Home'), 'url' => '/rbac/index', 'icon' => 'home'];
		$login = ['label' => Yii::t('app', 'Login'), 'url' => '/site/login', 'icon' => 'sign-in'];
		$logout = ['label' => Yii::t('app', 'Logout') . $dataLogout, 'url' => '/site/logout', 'icon' => $iconLogout, 'method' => 'post'];
		$tmp = ['label' => Yii::t('app', 'Home'), 'url' => '/rbac/index'];
		
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
		$i = [];
		
		if(!$guest){
			$items = [
				['label' => Yii::t('app', 'Roles'), 'url' => '/rbac/roles'],
				['label' => Yii::t('app', 'Groups'), 'url' => '/rbac/groups'],
				['label' => Yii::t('app', 'Permissions'), 'url' => '/rbac/permissions'],
				['label' => Yii::t('app', 'Assignments'), 'url' => '/rbac/assignments'],
			];
		}else{
			
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
		
		return $item;
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
        $user = \Yii::$app->user->identity;
        $guest = \Yii::$app->user->isGuest;
		
		return [];
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
        $user = \Yii::$app->user->identity;
        $guest = \Yii::$app->user->isGuest;
		
		return [];
    }
}
