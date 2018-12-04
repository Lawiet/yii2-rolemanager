<?php

use yii\helpers\Html;
use lawiet\rbac\web\Breadcrumbs;


/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = Yii::t('app', 'Create Users');
$this->params['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
