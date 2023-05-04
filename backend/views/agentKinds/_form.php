<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AgentKinds */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agent-kinds-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app/agents', 'Create') : Yii::t('app/agents', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
