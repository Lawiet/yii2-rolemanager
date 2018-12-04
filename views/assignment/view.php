<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use lawiet\rbac\web\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model lawiet\rbac\models\Assignment */

$this->title = $model->name;
$this->params['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
?>
<div class="assignment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'permission.name',
            'status:boolean',
            'show_in_menu:boolean',
            'name',
            'method',
            'date_modified',
            'date_created',
        ],
    ]) ?>

</div>
