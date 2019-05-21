<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AgentTypes */

$this->title = Yii::t('app/agents', 'Update {modelClass}: ', [
    'modelClass' => 'Agent Types',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/agents', 'Agent Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/agents', 'Update');
?>
<div class="agent-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
