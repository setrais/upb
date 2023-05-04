<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TypesIblocks */

$this->title = Yii::t('app', 'Create Types Iblocks');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Types Iblocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="types-iblocks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
