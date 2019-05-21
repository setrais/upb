<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
use backend\models\Iblocks;
use backend\models\TypesIblocks;
use backend\models\User;
use backend\models\Cities;
use yii\helpers\ArrayHelper;
use yii\icxp\helpers\HRu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IblocksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('menu/iblock', 'Iblocks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iblocks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('menu/iblock', 'Create Iblocks'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php
$gridList = implode(",", Iblocks::find()->select('grid')->groupBy('grid')->where("(TYPES_IBLOCKS_ID<>1 AND GRID<>0) AND (ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)")->asArray()->column());

Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            array( 'attribute'=>'id',
                   'visible'=>true,
                   'headerOptions' =>array('width'=>'80', 'style'=>'text-align:center;'),
                   'filterOptions' =>array('width'=>'80', 'style'=>'text-align:left;'),
                   //'fotterOptions' =>array('width'=>'25', 'style'=>'text-align:left;'),
                   'contentOptions'=>array('style'=>'padding-left:20px;width:25px;text-align:left;vertical-align: middle;'),
                   'label'=>'Ид.' ),
            array( 'attribute'=>'uid',
                   'headerOptions'=>array('class'=>'header-id'),
                   'filterOptions' =>array('class'=>'filter-id'),
                   'contentOptions'=>array('class'=>'content-id'),
                   'visible' => false,
                   'label'=>'Ун.Ид.' ),

            array( 'attribute'=>'nid',
                   'label'=>Yii::t('app/iblock','Вн.Ид.'),
                   'headerOptions'=>array('class'=>'header-id nid'),
                   'filterOptions' =>array('class'=>'filter-id nid'),
                   'contentOptions'=>array('class'=>'content-id nid'),
                   'visible'=>true
            ),
            array( 'attribute'=>'sid',
                   'label'=>Yii::t('app/iblock','Сим.Ид.'),
                   'headerOptions'=>array('class'=>'header-id sid'),
                   'filterOptions' =>array('class'=>'filter-id sid'),
                   'contentOptions'=>array('class'=>'content-id sid'),
                   'visible' => false
            ),
            array( 'attribute' => 'cid',
                'label' => Yii::t('app/iblock','Ид.контакта'),
                'headerOptions' => array('class'=>'header-id sid'),
                'filterOptions' => array('class'=>'filter-id sid'),
                'contentOptions' => array('class'=>'content-id sid'),
                'visible' => false
            ),

            array( 'attribute' => 'maps_id',
                'label' => Yii::t('app/iblock','Ид.карты'),
                'headerOptions' => array('class'=>'header-id sid'),
                'filterOptions' => array('class'=>'filter-id sid'),
                'contentOptions' => array('class'=>'content-id sid'),
                'visible' => false
            ),

            array( 'attribute' => 'city_id',
                'label' => Yii::t('app/iblock','Ид.города'),
                'headerOptions' => array('class'=>'header-id sid'),
                'filterOptions' => array('class'=>'filter-id sid'),
                'contentOptions' => array('class'=>'content-id sid'),
                'filter'=> ArrayHelper::map( Cities::find("", array("order"=>"name") )->asArray()->all(), 'id', 'name'),
                'value'=>'city.name',
                'visible'=>false,
            ),

            array( 'attribute'=>'name',
                   'format'=>'html',
                   'label'=>Yii::t('app/iblock','Наименование'),
            //     'headerOptions'=>array('class'=>'header-id'),
            //     'filterOptions' =>array('class'=>'filter-id'),
                   'contentOptions'=>array('class'=>'content-id grid name'),
                   'value' => function ($data) { return '<p>'.$data->name.'</p>'; },
                   'visible'=>true
            ),
            array( 'attribute'=>'grid',
                   'label'=>Yii::t('app/iblock','Section'),
                   'format'=>'text',
                   'contentOptions' => array('style'=>'width:'/*110*/.'70px;text-align:left;'),
                   'headerOptions' => array('width'=>'70', 'style'=>'text-align:left;'),
                   'filterOptions' => array('width'=>'70', 'style'=>'text-align:left;'),
                   'filter'=> ArrayHelper::map( Iblocks::find("", array("order"=>"name"))->where("id IN (".$gridList.") OR (GRID IS NULL)")->asArray()->all(), 'id', 'name'),
                   'value'=>'section.name',
                   'visible'=>true,
            ),

            array( 'attribute'=>'types_iblocks_id',
                   'label'=>Yii::t('app/label','Тип'),
                   'format'=>'text',
                   'contentOptions'=>array('style'=>'text-align:center;'),
                   'headerOptions' => array('width'=>'70', 'style'=>'text-align:left;'),
                   'filterOptions' => array('width'=>'70', 'style'=>'text-align:left;'),
                   'filter'=> ArrayHelper::map( TypesIblocks::find("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)", array("order"=>"sort") )->asArray()->all(), 'id', 'desc'),
                   'value'=>'type.desc',
                   'visible'=>true,
            ),

            array( 'attribute'=>'sort',
                   'label'=>Yii::t('app/iblock','Сорт.')),

            array( 'attribute'=>'act',
                   'label'=>Yii::t('app/all','Акт'),
                   'format'=>'text',
                   'filter'=> Html::activeCheckbox( $searchModel, 'act', array('label'=>'', 'class'=>"form-control", 'style'=>'margin:0px;width:10px;text-align:center;')),
                   'value'=>function($model) { return $model->act ? "x" : ""; },
                   'contentOptions'=>array('width'=>10,'style'=>'width:10px;text-align:center;'),
                   'headerOptions'=>array('width'=>10,'style'=>'text-align:center;'),
                   'visible'=>true,
            ),
            array ( 'attribute' => 'del',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'format' => 'html',
                    'value' => function ($data) {
                                     return $data->del ? '<span class="label label-success">Активный</span>'
                                                       : '<span class="label label-danger">Не активный</span>';
                    },
                    'filter' => Html::activeDropDownList( $searchModel , 'del',
                                [true => 'Активный', false => 'Не активный'],
                                ['class' => 'form-control filtered' /*'form-control input-sm filtered'*/, 'prompt' => 'Все']),
                    'visible'=>false
            ),
            array ( 'attribute' => 'is_main',
                    'label'=>Yii::t('app/all','Показ. на главной'),
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'format' => 'html',
                    'value' => function ($data) {
                        return $data->is_main ? '<span class="label label-success">Активный</span>'
                            : '<span class="label label-danger">Не активный</span>';
                    },
                    'filter' => Html::activeDropDownList( $searchModel , 'is_main',
                        [true => 'Активный', false => 'Не активный'],
                        ['class' => 'form-control filtered' /*'form-control input-sm filtered'*/, 'prompt' => 'Все']),
                    'visible'=>false
            ),
            array ( 'attribute' => 'is_pay',
                    'label'=>Yii::t('app/all','Подажа'),
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'format' => 'html',
                    'value' => function ($data) {
                        return $data->is_pay ? '<span class="label label-success">Активный</span>'
                            : '<span class="label label-danger">Не активный</span>';
                    },
                    'filter' => Html::activeDropDownList( $searchModel , 'is_pay',
                        [true => 'Активный', false => 'Не активный'],
                        ['class' => 'form-control filtered' /*'form-control input-sm filtered'*/, 'prompt' => 'Все']),
                    'visible'=>false
            ),
            array ( 'attribute' => 'is_arhiv',
                    'label'=>Yii::t('app/all','Архив'),
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'format' => 'html',
                    'value' => function ($data) {
                        return $data->is_arhiv ? '<span class="label label-success">Активный</span>'
                            : '<span class="label label-danger">Не активный</span>';
                    },
                    'filter' => Html::activeDropDownList( $searchModel , 'is_arhiv',
                        [true => 'Активный', false => 'Не активный'],
                        ['class' => 'form-control filtered' /*'form-control input-sm filtered'*/, 'prompt' => 'Все']),
                    'visible'=>false
            ),
            array ( 'attribute' => 'is_use',
                    'label'=>Yii::t('app/all','Исп-ние'),
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'format' => 'html',
                    'value' => function ($data) {
                        return $data->is_use ? '<span class="label label-success">Активный</span>'
                            : '<span class="label label-danger">Не активный</span>';
                    },
                    'filter' => Html::activeDropDownList( $searchModel , 'is_use',
                        [true => 'Активный', false => 'Не активный'],
                        ['class' => 'form-control filtered' /*'form-control input-sm filtered'*/, 'prompt' => 'Все']),
                    'visible'=>false
            ),
            array ( 'attribute' => 'is_resize',
                'label'=>Yii::t('app/all','Ресайз'),
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'format' => 'html',
                'value' => function ($data) {
                    return $data->is_resize ? '<span class="label label-success">Активный</span>'
                        : '<span class="label label-danger">Не активный</span>';
                },
                'filter' => Html::activeDropDownList( $searchModel , 'is_resize',
                    [true => 'Активный', false => 'Не активный'],
                    ['class' => 'form-control filtered' /*'form-control input-sm filtered'*/, 'prompt' => 'Все']),
                'visible'=>true
            ),

            array( 'attribute' => 'title',
                       'label' => Yii::t('app/label', 'SEO Заголовок'),
                     'visible' => false
            ),
            array( 'attribute' => 'keywords',
                      'format' => 'text',
                       'label' => Yii::t('app/label', 'SEO Слова'),
                     'visible' => false
            ),
            array( 'attribute' => 'description',
                      'format' => 'html',
                       'label' => Yii::t('app/label', 'SEO Описание'),
                       'value' => function ($data) { return '<p class="new">'.HRu::cutstr($data->description, 210, false, '...').'</p>'; },
               'headerOptions' => array('width'=>'60px'),
              'contentOptions' => array('class'=>'grid seo desc'),
                     'visible' => false
            ),
            array( 'attribute' => 'pic_scr_id',
                      'label'  => Yii::t('app/label','Скриншот'),
                      'format' => 'html',
                       'value' => function ( $model ) { return
                                    Html::a(
                                        Html::img( "/".
                                            ( $model->picScr &&
                                              file_exists($_SERVER['DOCUMENT_ROOT']."/".str_replace("_original","_src", trim( $model->picScr->original_name )))
                                                  ? str_replace("_original","_src", trim($model->picScr->original_name)) : ( $model->picOreginal &&
                                                  file_exists($_SERVER['DOCUMENT_ROOT']."/".str_replace("_original","_src", trim( $model->picOreginal->original_name )))
                                                      ? str_replace("_original","_src",trim( $model->picOreginal->original_name ))
                                                      : "images/no_foto_small.png" )),"", array( "title"=>( $model->picOreginal ? $model->picOreginal->name : '' ))
                                        ),
                                    	Url::to($model->picOreginal ? "/".$model->picOreginal->original_name : '#'),
                                        array("class"=>"fancyImage","alt"=>( $model->picOreginal ? $model->picOreginal->name : '#' ), "title"=>( $model->picOreginal ? $model->picOreginal->name : '' ))
                                    );
                                },
                      'filter' => '',
               'headerOptions' => array('width'=>'60'),
              'contentOptions' => array('style'=>'width:60px;text-align: center;vertical-align: middle;'),
                     'visible' => true,
            ),

            array( 'attribute' => 'pic_anons_id',
                       'label'  => Yii::t('app/label','Картинка анонса'),
                'format' => 'html',
                'value' => function ( $model ) { return
                    Html::a(
                        Html::img( "/".
                            ( $model->picAnons &&
                            file_exists($_SERVER['DOCUMENT_ROOT']."/".str_replace("_original","_small", trim( $model->picAnons->original_name )))
                                ? str_replace("_original","_small", trim($model->picAnons->original_name)) : ( $model->picOreginal &&
                                file_exists($_SERVER['DOCUMENT_ROOT']."/".str_replace("_original","_small", trim( $model->picOreginal->original_name )))
                                    ? str_replace("_original","_small",trim( $model->picOreginal->original_name ))
                                    : "images/no_foto_small.png" )),"", array( "title"=>( $model->picOreginal ? $model->picOreginal->name : '#' ))
                        ),
                        Url::to($model->picOreginal ? "/".$model->picOreginal->original_name : '#'),
                        array("class"=>"fancyImage","alt"=>( $model->picOreginal ? $model->picOreginal->name : '' ), "title"=>( $model->picOreginal ? $model->picOreginal->name : '' ))
                    );
                },
                'filter' => '',
                'headerOptions' => array('width'=>'60'),
                'contentOptions' => array('style'=>'width:60px;text-align: center;vertical-align: middle;'),
                'visible' => false,
            ),

            array( 'attribute' => 'anons',
              'contentOptions' => array('class'=>'grid anons'),
                       'value' => function ($data) { return '<p class="new">'.HRu::cutstr(strip_tags($data->anons), 210, false, '...').'</p>'; },
                      'format' => 'html',
                     'visible' => false ),

            array( 'attribute' => 'pic_detile_id',
                       'label'  => Yii::t('app/label','Картинка детально'),
                'format' => 'html',
                'value' => function ( $model ) { return
                    Html::a(
                        Html::img( "/".
                            ( $model->picDetile &&
                            file_exists($_SERVER['DOCUMENT_ROOT']."/".str_replace("_original","_big", trim( $model->picDetile->original_name )))
                                ? str_replace("_original","_big", trim($model->picDetile->original_name)) : ( $model->picOreginal &&
                                file_exists($_SERVER['DOCUMENT_ROOT']."/".str_replace("_original","_big", trim( $model->picOreginal->original_name )))
                                    ? str_replace("_original","_big",trim( $model->picOreginal->original_name ))
                                    : "images/no_foto_small.png" )),"", array( "title"=>( $model->picOreginal ? $model->picOreginal->name : '#' ))
                        ),
                        Url::to($model->picOreginal ? "/".$model->picOreginal->original_name : '#'),
                        array("class"=>"fancyImage","alt"=>( $model->picOreginal ? $model->picOreginal->name : '' ), "title"=>( $model->picOreginal ? $model->picOreginal->name : '' ))
                    );
                },
                'filter' => '',
                'headerOptions' => array('width'=>'60'),
                'contentOptions' => array('style'=>'width:60px;text-align: center;vertical-align: middle;'),
                'visible' => false,
            ),
            array( 'attribute' => 'detile',
                       'label' => Yii::t('app/label','Детально'),
              'contentOptions' => array('class'=>'grid detile'),
                       'value' => function ($data) { return '<p class="new">'.HRu::cutstr(strip_tags($data->detile), 320, false, '...').'</p>'; },
                      'format' => 'html',
                     'visible' => false ),

            array( 'attribute' => 'pic_oreginal_id',
                     'visible' => false ),

            array( 'attribute' => 'createusers',
                       'label' => Yii::t('app/iblock','Создал'),
                      'format' => 'text',
              'contentOptions' => array('style'=>'text-align:center;width:50px;'),
                       'value' => 'createUsers.username',
                      'filter' => Html::activeDropDownList( $searchModel , 'createusers',
                                    ArrayHelper::map( User::find("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                    array("order"=>"sort"))->asArray()->all(), 'id', 'username'),
                                    array('class'=>'form-control')
                               ),
                     'visible' => true,
            ),
            array( 'attribute' => 'createdate',
                       'label' => Yii::t('app/iblock','Дата создания'),
                       'value' => function ($model) { return date("d-m-Y",strtotime($model->createdate)); },
              'contentOptions' => array('style'=>'width:'/*110*/.'70px;text-align:center;'),
               'headerOptions' => array('width'=>'70', 'style'=>'text-align:center;'),
                     'visible' => true,
                      'filter' => DatePicker::widget( [ 'model' => $searchModel,
                   'attribute' => 'createdate',
                     'options' => ['class' => 'form-control', 'autocomplete' => 'on','style'=>'width:96px;text-align:center;'],
               'clientOptions' => ['forceParse' => true, 'todayBtn' => true, 'clearBtn' => true, 'autoclose' => true, 'todayHighlight' => true, 'format' => 'dd.mm.yyyy'],
                    'language' => 'ru',
                  'dateFormat' => 'dd-MM-yyyy']
                ),
            ),
            array( 'attribute' => 'updateusers',
                       'label' => Yii::t('app/iblock','Изменил'),
                      'format' => 'text',
              'contentOptions' => array('style'=>'text-align:center;width:50px;'),
                       'value' => 'updateUsers.username',
                      'filter' => Html::activeDropDownList( $searchModel , 'updateusers', ArrayHelper::map( User::find("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                        array("order"=>"sort"))->asArray()->all(), 'id', 'username'), array('class'=>'form-control')),
                     'visible' => true,
            ),
            array( 'attribute' => 'updatedate',
                       'label' => Yii::t('app/iblock','Дата создания'),
                       'value' => function ($model) { return date("d-m-Y",strtotime($model->updatedate)); },
              'contentOptions' => array('style'=>'width:'/*110*/.'70px;text-align:center;'),
               'headerOptions' => array('width'=>'70', 'style'=>'text-align:center;'),
                     'visible' => true,
                    /*'filterOptions' => function($model) {
                        foreach ($model->agentKinds as $kind) {
                            $kindNames[] = $kind->name;
                    }
                        return implode("\n", $kindNames);
                    },*/
                     'filter' => DatePicker::widget( [ 'model' => $searchModel,
                            'attribute' => 'updatedate',
                            'options' => ['class' => 'form-control', 'autocomplete' => 'on','style'=>'width:96px;text-align:center;'],
                            'clientOptions' => ['forceParse' => true, 'todayBtn' => true, 'clearBtn' => true, 'autoclose' => true, 'todayHighlight' => true, 'format' => 'dd.mm.yyyy'],
                            'language' => 'ru',
                            'dateFormat' => 'dd-MM-yyyy']
                    ),
            ),
            array( 'attribute' => 'url',
                   'label' => Yii::t('app/iblock','Страница анонса'),
                   'format' => 'url',
                   'value' => function ($model) { return Yii::$app->request->getServerName().$model->url; },
                   'visible' => false ),
            array( 'attribute' => 'url_detile',
                   'label' => Yii::t('app/iblock','Страница детально'),
                   'value' => function ($model) { return Yii::$app->request->getServerName().$model->url_detile; },
                   'format' => 'url',
                   'visible' => false ),
            array( 'attribute' => 'url_list',
                   'label' => Yii::t('app/iblock','Страница списка'),
                   'format' => 'url',
                   'value' => function ($model) { return Yii::$app->request->getServerName().$model->url_list; },
                   'visible' => false ),

            array( 'attribute' => 'visible',
                   'label' => Yii::t('app/iblock','Условие показа'),
                   'format' => 'text',
                   'visible' => false ),

            array( 'attribute' => 'action',
                   'label' => Yii::t('app/iblock','Действие'),
                   'format' => 'text',
                   'visible' => false ),

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
