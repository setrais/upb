<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Iblocks */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/iblock', 'Iblocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iblocks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/iblock', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/iblock', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app/iblock', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'uid',
            'grid',
            'name',
            'sid',
            'title',
            'keywords:ntext',
            'description:ntext',
            'anons:ntext',
            'pic_anons_id',
            'pic_detile_id',
            'act',
            'del',
            'createusers',
            'createdate',
            'updateusers',
            'updatedate',
            'detile:ntext',
            'sort',
            'cid',
            'is_main',
            'is_pay',
            'is_arhiv',
            'is_use',
            'maps_id',
            'types_iblocks_id',
            'url:url',
            'url_detile:url',
            'url_list:url',
            'city_id',
            'visible',
            'action',
            'is_resize',
            'pic_oreginal_id',
            'pic_scr_id',
            'nid',
        ],
    ]) ?>

</div>
