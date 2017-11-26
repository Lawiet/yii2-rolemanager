<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model lawiet\rbac\models\PermissionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permission-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_permission') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'logged') ?>

    <?= $form->field($model, 'show_in_menu') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'uri') ?>

    <?php // echo $form->field($model, 'icon') ?>

    <?php // echo $form->field($model, 'data_method') ?>

    <?php // echo $form->field($model, 'date_modified') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
