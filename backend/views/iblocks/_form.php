<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Iblocks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="iblocks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grid')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'anons')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pic_anons_id')->textInput() ?>

    <?= $form->field($model, 'pic_detile_id')->textInput() ?>

    <?= $form->field($model, 'act')->textInput() ?>

    <?= $form->field($model, 'del')->textInput() ?>

    <?= $form->field($model, 'createusers')->textInput() ?>

    <?= $form->field($model, 'createdate')->textInput() ?>

    <?= $form->field($model, 'updateusers')->textInput() ?>

    <?= $form->field($model, 'updatedate')->textInput() ?>

    <?= $form->field($model, 'detile')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'cid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_main')->textInput() ?>

    <?= $form->field($model, 'is_pay')->textInput() ?>

    <?= $form->field($model, 'is_arhiv')->textInput() ?>

    <?= $form->field($model, 'is_use')->textInput() ?>

    <?= $form->field($model, 'maps_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'types_iblocks_id')->textInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_detile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_list')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_id')->textInput() ?>

    <?= $form->field($model, 'visible')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'action')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_resize')->textInput() ?>

    <?= $form->field($model, 'pic_oreginal_id')->textInput() ?>

    <?= $form->field($model, 'pic_scr_id')->textInput() ?>

    <?= $form->field($model, 'nid')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app/iblock', 'Create') : Yii::t('app/iblock', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
