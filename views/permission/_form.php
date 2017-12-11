<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use wbraganca\multiselect\MultiSelectWidget;

/* @var $this yii\web\View */
/* @var $model lawiet\rbac\models\Permission */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permission-form">

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

    <?php // $form->field($model, 'id_permission')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), []); ?>

    <?= $form->field($model, 'logged')->widget(SwitchInput::classname(), []); ?>

    <?= $form->field($model, 'show_in_menu')->widget(SwitchInput::classname(), []); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder'=> Yii::t('app','Enter a Name...')]) ?>

    <?= $form->field($model, 'uri')->textInput(['maxlength' => true, 'placeholder'=> Yii::t('app','Enter a valid uri address...')]) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true, 'placeholder'=> Yii::t('app','Enter a icon...')]) ?>

<<<<<<< HEAD
    <?= $form->field($model, 'data_method')->widget(MultiSelectWidget::classname(), [
=======
    <?= $form->field($model, 'date_created')->widget(MultiSelectWidget::classname(), [
        'options' => [
            //'multiple' => 'multiple',
        ],
        'clientOptions' => [
            'nonSelectedText' => Yii::t('app', 'Check an option!'),
            'nSelectedText' => ' - ' . Yii::t('app', 'Options selected!'),
            'allSelectedText' => Yii::t('app', 'All Selected'),
            //'selectAllText' => Yii::t('app', 'Select all'),
            'numberDisplayed' => 1,
            //'enableCaseInsensitiveFiltering' => true,
            'maxHeight' => 600, // The maximum height of the dropdown. This is useful when using the plugin with plenty of options.
            //'includeSelectAllOption' => true
        ],
>>>>>>> 73f7458e7f63c488e038d7d87aed7cc5fda718a1
        'data' => ['GET', 'POST', 'PUT', 'DELETE'],
        'model' => $model,
        'attribute' => 'date_modified',
    ]); ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
