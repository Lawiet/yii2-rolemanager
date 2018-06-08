<?php

use yii\helpers\Html;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Organizations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organizations-form">

    <?php  $form = ActiveForm::begin([
        'id' => 'organizations-form',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'enableAjaxValidation' => false,
        'formConfig' => [ 
            'showLabels' => true,
            'labelSpan' => 3,
            'showErrors' => true,
        ],
    ]); ?>
	
	<?= Form::widget([
		'model'=>$model,
		'form'=>$form,
		'attributes'=>$model->formAttribs,
	]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
