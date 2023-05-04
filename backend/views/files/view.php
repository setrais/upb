<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Files */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'uid',
            'status',
            'name',
            'timetamp_x',
            'order',
            'height',
            'width',
            'file_size',
            'ext',
            'subdir',
            'file_name',
            'original_name',
            'content_type',
            'module_id',
            'handler_id',
            'created_user',
            'updated_user',
            'created',
            'updated',
            'description',
            'action',
            'controller',
        ],
    ]) ?>

</div>
