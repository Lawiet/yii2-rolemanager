<?php

use yii\helpers\Html;
use lawiet\rbac\web\Breadcrumbs;


/* @var $this yii\web\View */
/* @var $model lawiet\rbac\models\Assignment */

$this->title = Yii::t('app', 'Create Assignment');
$this->params['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
?>
<div class="assignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
