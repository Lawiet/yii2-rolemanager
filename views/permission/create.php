<?php

use yii\helpers\Html;
use lawiet\rbac\web\Breadcrumbs;


/* @var $this yii\web\View */
/* @var $model lawiet\rbac\models\Permission */

$this->title = Yii::t('app', 'Create Permission');
$this->params['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
?>
<div class="permission-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
