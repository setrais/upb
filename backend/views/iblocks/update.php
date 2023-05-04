<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Iblocks */

$this->title = Yii::t('app/iblock', Yii::t('all/application','Update').' {modelClass}: ', [
    'modelClass' => Yii::t('all/iblock', 'Iblocks'),
]) . Yii::t('all/application',$model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('all/iblock', 'Iblocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('all/application',$model->name), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('all/application', 'Update');
?>
<div class="iblocks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
