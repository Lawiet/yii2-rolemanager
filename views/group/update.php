<?php

use yii\helpers\Html;
use lawiet\rbac\web\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model lawiet\rbac\models\Group */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Group',
]) . $model->name;
$this->params['breadcrumbs'] = Breadcrumbs::getBreadcrumbs($model->name, $model->id);
?>
<div class="group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
