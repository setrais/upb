<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AgentKinds */

$this->title = Yii::t('app/agents', 'Update {modelClass}: ', [
    'modelClass' => 'Agent Kinds',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/agents', 'Agent Kinds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/agents', 'Update');
?>
<div class="agent-kinds-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
