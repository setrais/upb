<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\IblocksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="iblocks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'grid') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'sid') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'anons') ?>

    <?php // echo $form->field($model, 'pic_anons_id') ?>

    <?php // echo $form->field($model, 'pic_detile_id') ?>

    <?php // echo $form->field($model, 'act') ?>

    <?php // echo $form->field($model, 'del') ?>

    <?php // echo $form->field($model, 'createusers') ?>

    <?php // echo $form->field($model, 'createdate') ?>

    <?php // echo $form->field($model, 'updateusers') ?>

    <?php // echo $form->field($model, 'updatedate') ?>

    <?php // echo $form->field($model, 'detile') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'cid') ?>

    <?php // echo $form->field($model, 'is_main') ?>

    <?php // echo $form->field($model, 'is_pay') ?>

    <?php // echo $form->field($model, 'is_arhiv') ?>

    <?php // echo $form->field($model, 'is_use') ?>

    <?php // echo $form->field($model, 'maps_id') ?>

    <?php // echo $form->field($model, 'types_iblocks_id') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'url_detile') ?>

    <?php // echo $form->field($model, 'url_list') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <?php // echo $form->field($model, 'action') ?>

    <?php // echo $form->field($model, 'is_resize') ?>

    <?php // echo $form->field($model, 'pic_oreginal_id') ?>

    <?php // echo $form->field($model, 'pic_scr_id') ?>

    <?php // echo $form->field($model, 'nid') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app/iblock', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app/iblock', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
