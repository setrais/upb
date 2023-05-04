<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Agents */

$this->title = Yii::t('app/agents', 'Create Agents');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/agents', 'Agents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
