<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Iblocks */

$this->title = Yii::t('menu/iblock', 'Create Iblocks');
$this->params['breadcrumbs'][] = ['label' => Yii::t('all/iblock', 'Iblocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iblocks-create">

    <h1><?= Html::encode(Yii::t('menu/iblock',$this->title)) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
