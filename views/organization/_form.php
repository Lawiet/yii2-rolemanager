<?php

use kartik\builder\Form;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Organizations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organizations-form">

    <?php 
	$form = ActiveForm::begin([
        'id' => 'role-form',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'enableAjaxValidation' => false,
        'formConfig' => [ 
            'showLabels' => true,
            'labelSpan' => 3,
            'showErrors' => true,
        ],
    ]);
	echo Form::widget([
		'model'=>$model,
		'form'=>$form,
		'columns'=>2,
		'attributes'=>$model->formAttribs
	]);
	//echo Html::button('Submit', ['type'=>'button', 'class'=>'btn btn-primary']);
	ActiveForm::end();
	
	
	
	/* $form = ActiveForm::begin([
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

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder'=> Yii::t('app','Enter a Name...')]) ?>
	
	<?= $form->field($model, 'id_group')->widget(Select2::classname(), [
		'data' => $modelGroup,
		'options' => [
			'placeholder' => Yii::t("app", "Select a group"),
			'required' => true,
		],
		'pluginOptions' => [
			//'tags' => true,
			'tokenSeparators' => [',', ' '],
			'maximumInputLength' => 10,
		],
	]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); */ ?>

</div>
