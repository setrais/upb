<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AgentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agents-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kind_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'f') ?>

    <?= $form->field($model, 'i') ?>

    <?php // echo $form->field($model, 'o') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'fullname') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app/agents', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app/agents', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
