<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use wbraganca\selectivity\SelectivityWidget;

/* @var $this yii\web\View */
/* @var $model lawiet\rbac\models\Group */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-form">

    <?php $form = ActiveForm::begin([
        'id' => 'signup-form',
        'type' => ActiveForm::TYPE_VERTICAL,
        'enableAjaxValidation' => true,
        'formConfig' => [
            'showLabels' => true,
            'labelSpan' => 3,
            'showErrors' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), []); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder'=> Yii::t('app','Enter a Name...')]) ?>

    <?= $form->field($model, 'date_created')->widget(SelectivityWidget::classname(), [
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true,
            'items' => ['Amsterdam', 'Antwerp'],
            'placeholder' => Yii::t('app', 'Check an option!'),
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
