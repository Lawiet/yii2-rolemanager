<?php

use yii\helpers\Html;
use yii\grid\GridView;
use lawiet\rbac\web\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel lawiet\rbac\models\GroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Groups');
$this->params['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
?>
<div class="group-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Group'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'status:boolean',
            'name',
            // 'date_modified',
            // 'date_created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
