<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin([
        'id' => 'role-form',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'enableAjaxValidation' => false,
        'formConfig' => [ 
            'showLabels' => true,
            'labelSpan' => 3,
            'showErrors' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), []); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder'=> Yii::t('app','Enter a Name...')]) /* ?>

    <?= $form->field($model, 'permissions')->widget(Select2::classname(), [
        'data' => [],
		'name' => 'permissions',
		'options' => [
			'placeholder' => Yii::t("app", "Select a permission"), 
			'multiple'=>true,
			"required" => true
		],
		'pluginOptions' => [
			//'tags' => true,
			'allowClear' => false,
			'tokenSeparators' => [',', ' '],
			'maximumInputLength' => 10
		],
    ]); */ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
