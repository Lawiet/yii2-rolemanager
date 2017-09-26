<?php

namespace lawiet\rbac\assets;

use yii\web\AssetBundle;
use yii\filters\AccessControl;

/**
 * module for rbac.
 *
 * @author Jorge Gonzalez
 * @email ljorgelgonzalez@outlook.com
 *
 * @since 1.0
 */

class RbacAsset extends AssetBundle
{

    // Predeterminado por Yii
    public $basePath = '@webroot';
    public $baseUrl = '@web';

	// Manejo predeterminado de css
    public $css = [
        'css/site.css',
    ];
	
    //dependencias predeterminadas
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'kartik\icons\FontAwesomeAsset',
    ];
	
	/** 
     * @inheritdoc 
     */ 
    public function init() 
    {
		parent::init();
	}
	
	/** 
     * @inheritdoc 
     */ 
    public function addDepends($depends) 
    {
		if(is_array($depends))
			if(count($depends) > 0)
				foreach($depends as $depend)
					$this->depends[] = $depend;
		else
			$this->depends[] = $depends;
	}
	
	/** 
     * @inheritdoc 
     */ 
    public function addCss($css) 
    {
		if(is_array($css))
			if(count($css) > 0)
				foreach($css as $cs)
					$this->css[] = $cs;
		else
			$this->css[] = $css;
	}
	
}
