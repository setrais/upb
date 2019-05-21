<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Iblocks */

$this->title = Yii::t('app/iblock', 'Update {modelClass}: ', [
    'modelClass' => 'Iblocks',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/iblock', 'Iblocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/iblock', 'Update');
?>
<div class="iblocks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
