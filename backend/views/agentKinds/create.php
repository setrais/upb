<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AgentKinds */

$this->title = Yii::t('app/agents', 'Create Agent Kinds');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/agents', 'Agent Kinds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-kinds-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
