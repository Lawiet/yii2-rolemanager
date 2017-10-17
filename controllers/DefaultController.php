<?php

namespace lawiet\rbac\controllers;

use lawiet\rbac\web\Controller;

/**
 * Default controller for the `lawiet` module
 */
class DefaultController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
		$this->layout = parent::getLayout();

		return parent::behaviors();
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionTest()
    {
        return $this->render('index');
    }
}
