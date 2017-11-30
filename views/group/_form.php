<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use wbraganca\multiselect\MultiSelectWidget;

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

    <?= $form->field($model, 'date_created')->widget(MultiSelectWidget::classname(), [
        'options' => [
            'multiple' => 'multiple',
        ],
        'clientOptions' => [
            'nonSelectedText' => Yii::t('app', 'Check an option!'),
            'nSelectedText' => ' - ' . Yii::t('app', 'Options selected!'),
            'allSelectedText' => Yii::t('app', 'All Selected'),
            'selectAllText' => Yii::t('app', 'Select all'),
            'numberDisplayed' => 1,
            //'enableCaseInsensitiveFiltering' => true,
            'maxHeight' => 600, // The maximum height of the dropdown. This is useful when using the plugin with plenty of options.
            'includeSelectAllOption' => true
        ],
        'data' => ['Activo', 'inactivo'],
        'model' => $model,
        'attribute' => 'date_modified',
    ]); ?>

    <?= MultiSelectWidget::widget([
        'options' => [
            'multiple' => 'multiple',
        ],
        'clientOptions' => [
            'nonSelectedText' => Yii::t('app', 'Check an option!'),
            'nSelectedText' => ' - ' . Yii::t('app', 'Options selected!'),
            'allSelectedText' => Yii::t('app', 'All Selected'),
            'selectAllText' => Yii::t('app', 'Select all'),
            'numberDisplayed' => 1,
            //'enableCaseInsensitiveFiltering' => true,
            'maxHeight' => 600, // The maximum height of the dropdown. This is useful when using the plugin with plenty of options.
            'includeSelectAllOption' => true
        ],
        'data' => ['Activo', 'inactivo'],
        'model' => $model,
        'attribute' => 'date_modified',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
