<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FilesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'timetamp_x') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'width') ?>

    <?php // echo $form->field($model, 'file_size') ?>

    <?php // echo $form->field($model, 'ext') ?>

    <?php // echo $form->field($model, 'subdir') ?>

    <?php // echo $form->field($model, 'file_name') ?>

    <?php // echo $form->field($model, 'original_name') ?>

    <?php // echo $form->field($model, 'content_type') ?>

    <?php // echo $form->field($model, 'module_id') ?>

    <?php // echo $form->field($model, 'handler_id') ?>

    <?php // echo $form->field($model, 'created_user') ?>

    <?php // echo $form->field($model, 'updated_user') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'action') ?>

    <?php // echo $form->field($model, 'controller') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
