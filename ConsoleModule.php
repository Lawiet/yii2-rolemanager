<?php

namespace lawiet\rbac;

use yii\base\Module;

/**
 * console module for rbac.
 *
 * @author Jorge Gonzalez
 * @email ljorgelgonzalez@outlook.com
 *
 * @since 1.0
 */
class ConsoleModule extends Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'lawiet\rbac\commands';
}
