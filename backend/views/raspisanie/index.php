<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use backend\models\Raspisanie;
use backend\models\RaspisanieSearch;
use backend\models\Uids;
use yii\icxp\helpers\HDate;
use yii\jui\DatePicker;
use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RaspisanieSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/form', 'Raspisanies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raspisanie-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Raspisanie'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            array(  'attribute' => 'id',
                        'label' => Yii::t('app/label','Ид.записи'),
                      'visible' => false),
            array(  'attribute' => 'grid',
                        'label' => Yii::t('app/label', 'Ид.группы'),
                       'format' => 'raw',
                        'value' => 'gr.name',
                'filterOptions' => array('width'=>120, 'style'=>'text-align:left;'),
               'contentOptions' => array('width'=>120, 'style'=>'text-align:left;'),
                'headerOptions' => array('width'=>120, 'style'=>'text-align:left;'),
                       'filter' => ArrayHelper::map(Raspisanie::find('')->orderBy('name')->where('GRID IS NULL')->asArray()->all(),'id','name'),
                      'visible' => true ),
            array(  'attribute' => 'cid',
                        'label' => Yii::t('app/label','Ид.календаря'),
                      'visible' => false ),
            array(  'attribute' => 'uids.table',
                        'value' => 'uids.table',
                      'visible' => true ),
            array(  'attribute' => 'uids.title',
                        'value' => 'uids.title',
                      'visible' => true ),
            array(  'attribute' => 'uids.description',
                        'value' => 'uids.description',
                      'visible' => true ),
            array(  'attribute' => 'uids.keywords',
                        'value' => 'uids.keywords',
                      'visible' => true ),
            array(  'attribute' => 'uids.createdate',
                        'value' => 'uids.createdate',
                      'visible' => true ),
            array(  'attribute' => 'uids.updatedate',
                        'value' => 'uids.updatedate',
                      'visible' => true ),
            array(  'attribute' => 'uids.createuser',
                        'value' => 'uids.createuser',
                      'visible' => true ),
            array(  'attribute' => 'uids.updateuser',
                        'value' => 'uids.updateuser',
                      'visible' => true ),
            array(  'attribute' => 'uids.createuser',
                        'value' => 'uids.createuser',
                      'visible' => true ),
            array(  'attribute' => 'uids.act',
                        'label' => Yii::t('app/all', 'Акт'),
                'filterOptions' => array('style'=>'text-align:center'),
               'contentOptions' => array( 'style'=> 'text-align:center'),
                       'format' => 'html',
                        'value' => function ( $data ) {
                                        return $data->uids->act ? '<span class="label label-success" >Активный</span>'
                                                                :  '<span class="label label-danger" >Не активный</span>';
                        },
                       'filter' => HTML::activeDropDownList( $searchModel,'uids.act', ['true' => 'Активный', 'false'=>'Не активный'], ['class'=>'form-control filtered', 'prompt'=>'Все']),
                      'visible' => true ),
            array(  'attribute' => 'uids.del',
                        'value' => 'uids.del',
                      'visible' => true ),
            array(  'attribute' => 'sort',
                        'label' => Yii::t('app/label','Сортировка'),
                      'visible' => false ),
            array(  'attribute' => 'name',
                        'label' => Yii::t('app/label','Наименование'),
                       'format' => 'text',
                'filterOptions' => array('width'=>120, 'style'=>'text-align:left'),
               'contentOptions' => array('width'=>120, 'style'=>'text-align:left'),
                'headerOptions' => array('width'=>120, 'style'=>'text-align:left'),
                      'visible' => true ),
            array(  'attribute' => 'date',
                        'label' => Yii::t('app/label','Дата события'),
                       'format' => 'text',
                        'value' => function( $model ) { return $model->date <> '' ? date('m.d.Y', strtotime( $model->date )) : ''; },
                'filterOptions' => array('width'=>70, 'style'=>'text-align:center'),
               'contentOptions' => array('width'=>70, 'style'=>'text-align:center'),
                'headerOptions' => array('width'=>70, 'style'=>'text-align:center'),
                      'visible' => false ),
            array(  'attribute' => 'dayweek',
                        'label' => Yii::t('app/label','День недели'),
                       'format' => 'text',
                        'value' => function( $model ) { return $model->date <> '' ? HDate::ruNumToDay( date('w', strtotime(  $model->date )) ? date('w', strtotime(  $model->date )) : 7 , false) : ''; },
                'filterOptions' => array('width'=>50, 'style'=>'text-align:center'),
               'contentOptions' => array('width'=>50, 'style'=>'text-align:center'),
                'headerOptions' => array('width'=>50, 'style'=>'text-align:center'),
                       'filter' => false,
                      'visible' => true ),
            array(  'attribute' => 'daymounth',
                        'label' => Yii::t('app/label','Число месяцая'),
                       'format' => 'text',
                        'value' => function( $model ) { return $model->date <> '' ? date('d', strtotime( $model->date )) : ''; },
                'filterOptions' => array('width'=>70, 'style'=>'text-align:center'),
               'contentOptions' => array('width'=>70, 'style'=>'text-align:center'),
                'headerOptions' => array('width'=>70, 'style'=>'text-align:center'),
                      'visible' => true ),
            array(  'attribute' => 'mounth',
                        'label' => Yii::t('app/label','Месяц'),
                       'format' => 'text',
                        'value' => function( $model ) { return  HDate::ruMonth( intval(date('m', strtotime(  $model->date )))); },
                'filterOptions' => array('width'=>50, 'style'=>'text-align:center'),
               'contentOptions' => array('width'=>50, 'style'=>'text-align:center'),
                'headerOptions' => array('width'=>50, 'style'=>'text-align:center'),
                       'filter' => false,
                      'visible' => true ),
            /*array(  'attribute' => 'time',
                        'label' => Yii::t('app/label','Время'),
                       'format' => 'text',
                        'value' => function( $model ) { return date('H:i', strtotime(  $model->time )); },
                'filterOptions' => array('width'=>50, 'style'=>'text-align:center'),
               'contentOptions' => array('width'=>50, 'style'=>'text-align:center'),
                'headerOptions' => array('width'=>50, 'style'=>'text-align:center'),
                       'filter' => false,
                      'visible' => true ),
            array(  'attribute' => 'time',
                        'label' => Yii::t('app/label','День года'),
                       'format' => 'date',
                        'value' => function( $model ) { return date('d-m-Y H:i:s', strtotime( $model->time )); },
                'filterOptions' => array('width'=>50, 'style'=>'text-align:center'),
               'contentOptions' => array('width'=>50, 'style'=>'text-align:center'),
                'headerOptions' => array('width'=>50, 'style'=>'text-align:center'),
                       'filter' => false,
                      'visible' => false ),*/
            array(  'attribute' => 'time',
                        'label' => Yii::t('app/label','Дата и время'),
                        'value' => function( $model ) { return date('d.m.Y H:i', strtotime( $model->time )); },
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'filterOptions' => array('width'=>120, 'style'=>'text-align:left'),
               'contentOptions' => array('width'=>120, 'style'=>'text-align:left; padding-left: 20px;'),
                'headerOptions' => array('width'=>120, 'style'=>'text-align:center'),
                       'filter' => DateTimePicker::widget([
                                     'model' => $searchModel,
                                 'attribute' => 'time',
                                      'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
                                    //'type' => DateTimePicker::TYPE_INPUT,
                                      'size' => 'md',
                             'convertFormat' => true,
                                    'layout' => '{input}{picker}{remove}',
                                   'options' => ['placeholder' => 'Введите дату и время ...', 'style'=>'width:150px'],
                             'pluginOptions' => ['language' => 'ru',
                                                   'format' => 'dd.MM.yyyy hh:i',
                                           'todayHighlight' => true,
                                                'autoclose' => true,
                                           ],
                                  'readonly'=> false,
                       ]),
                      'visible' => true ),
                   /*'desc:ntext',
                      'title',
                'description',
                   'keywords',*/

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
