<?php

use yii\helpers\Html;
use lawiet\rbac\web\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model lawiet\rbac\models\Permission */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Permission',
]) . $model->name;
$this->params['breadcrumbs'] = Breadcrumbs::getBreadcrumbs($model->name, $model->id);
?>
<div class="permission-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
