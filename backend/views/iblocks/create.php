<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Iblocks */

$this->title = Yii::t('app/iblock', 'Create Iblocks');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/iblock', 'Iblocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iblocks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
