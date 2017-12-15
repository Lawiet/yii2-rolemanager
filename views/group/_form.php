<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use lawiet\multiselect\MultiSelectBoxWidget;

/* @var $this yii\web\View */
/* @var $model lawiet\rbac\models\Group */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-form">

    <?php $form = ActiveForm::begin([
        'id' => 'signup-form',
        'type' => ActiveForm::TYPE_VERTICAL,
        'enableAjaxValidation' => false,
        'formConfig' => [
            'showLabels' => true,
            'labelSpan' => 3,
            'showErrors' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), []); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder'=> Yii::t('app','Enter a Name...')]) ?>

    <?= $form->field($modelGroupRole, 'id_rol')->widget(MultiSelectBoxWidget::classname(), [
        'options' => [
            'multiple' => 'multiple',
        ],
        'data' => $modelRole,
        'model' => $modelGroupRole,
        'attribute' => 'id_rol',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
