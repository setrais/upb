<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\jui\DatePicker;
use backend\models\Iblocks;
use backend\models\TypesIblocks;
use backend\models\User;
use backend\models\Cities;
use backend\models\Countries;
use yii\helpers\ArrayHelper;
use yii\jui\Tabs;
use yii\web\View;
use newerton\fancybox\FancyBox;
use yii\icxp\helpers\HRu;
use mihaildev\ckeditor\CKEditor;
use kartik\datetime\DateTimePicker;

?>
<div class="iblocks-form">

    <p class="note"><?=Yii::t('app/main','*');?></p>

    <?php $form = ActiveForm::begin(
            [                 'id' => 'iblocks-form',
            'enableAjaxValidation' => false,
                          'method' => 'post',
                         'options' => ['class' => 'form-horizontal',/*'form-inline'*/],
            ]); ?>
    <?php echo $form->errorSummary($model); ?>
    <?php /* $form=$this->beginWidget('CActiveForm', array(
        'id'=>'iblocks-form',
        'enableAjaxValidation'=>false,
        'method'=>'post',
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    )); */?>

    <?php /* Begin main of tabs the infoblock */ ob_start(); ?>
    <div class="tabs">
        <div class="row">
            <?= $form->field($model, 'name', [
                    'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                    'labelOptions' => ['class'=> 'control-label col-sm-2' ]])->textInput(['maxlength' => true, 'style'=>'width:380px','size'=>60, 'maxlength'=>255])->error() ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'act', [
                        'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                    'labelOptions' => ['class'=> 'control-label col-sm-2' ]])->checkBox(['class'=>'form-control', 'style'=>'box-shadow:none;width:34px', 'id'=>'act' ],false)->error() ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'sort', [
                        'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                    'labelOptions' => ['class'=> 'control-label col-sm-2' ]])->textInput(array('style'=>'width:70px;', 'maxlength'=>'4'))->error() ?>
        </div>

        <div class="row">
            <?= $form->field($model, 'types_iblocks_id', [
                        'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                    'labelOptions' => ['class'=> 'control-label col-sm-2' ]])->dropDownList(
                    ArrayHelper::map( TypesIblocks::find("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)"
                                    , array("order"=>"sort") )->asArray()->all(), 'id', 'desc')
                                    , array('prompt'=>Yii::t('all/application','Select')."...",'onchange'=>'getAjaxSection()'))->error() ?>
            <script>
                function getAjaxSection() {
                    var action = "/admin/iblocks/getajaxsection/";
                    var types_iblocks_id = $("#iblocks-types_iblocks_id").val();
                    if (types_iblocks_id) {
                        $.ajax({    url: action,
                            data: { types_iblocks_id : types_iblocks_id },
                            type: "POST",
                            success: function(data)
                            {
                                $('#grid').html(data);
                                $('#grid').removeClass('hidden');
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                alert(XMLHttpRequest.responseText);
                            }
                        });
                    }else{
                        $('#grid').addClass('hidden');
                    }
                }
            </script>
        </div>
        <div class="row" id="grid" >
            <?php
                if ( $model->grid )  {
                    $data = ArrayHelper::map( Iblocks::find("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0) ".( trim($model->types_iblocks_id)<>'' ? "AND (TYPES_IBLOCKS_ID='".$model->types_iblocks_id."')" : "")."AND ((GRID=0)OR(GRID IS NULL))",
                                            array("order"=>"sort"))->all(), 'id', 'name');
                    if ( !empty($data) ) {
                        echo $form->field($model, 'grid', [
                                'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                            'labelOptions' => ['class'=> 'control-label col-sm-2' ]])->dropDownList( $data ) ->error();
                    }
                }
            ?>
        </div>
        <div class="row" >
            <?php
                $htmlOpt = array( "onclick"=>" if ( $('#iblocks-is_resize').is('[checked]') ) "
                ."{ "
                ."  $('#iblocks-is_resize').removeAttr('checked');"
                ."  $('#pic_oreginal').hide(); "
                ."  $('#pic_scr').show(); $('#pic_scr').removeClass('hidden'); $('#pic_anons').show(); $('#pic_anons').removeClass('hidden'); $('#pic_detile').show();$('#pic_detile').removeClass('hidden');"
                ."}else{"
                ."  $('#iblocks-is_resize').attr('checked','checked');"
                ."  $('#pic_oreginal').show(); $('#pic_oreginal').removeClass('hidden'); "
                ."  $('#pic_scr').hide(); $('#pic_anons').hide(); $('#pic_detile').hide();"
                ."}", "class"=>"form-control", "style"=>"box-shadow:none;width:34px");
                if ( $model->is_resize===null ) $htmlOpt = array_merge($htmlOpt,array("checked"=> "checked"));
            ?>
            <?= $form->field($model, 'is_resize', [
                                'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                            'labelOptions' => ['class'=> 'control-label col-sm-2' ]])->checkbox( $htmlOpt, false )->error() ?>
        </div>
        <div id="pic_oreginal" class="row <?=( $model->is_resize || $model->is_resize===null ? '' : 'hidden' );?>">
            <div class="col">
            <?php echo $form->field($model,'picOreginal', [
                       'template' => "{label}\n<div class='col-sm-2 col-md-4'>{input}</div><div class='col-sm-2 col-md-4'>".Html::button('Очистить', array( 'class'=>'btn btn-primary','onclick'=>"$('#pic_anons #ytIblocks_picOreginal').val('');$('#pic_oreginal #Iblocks_picOreginal').val('');" ))."</div>\n{hint}\n{error}",
                       'labelOptions' => ['class'=> 'control-label col-sm-2' ],
                       'options' => ['class'=>'form-group m-b5' ]]
            )->fileInput(['class'=>'btn btn-default'])->label(Yii::t('label/all','Pic Oreginal'))->error(); ?>
            <?php if ( trim($model->pic_oreginal_id)<>"" ) : ?>
                <?php  echo "<div class=\"col-sm-2\">&nbsp;</div>"; ?>
                <?php  echo "<div class=\"col-sm small\"><span class=\"m-l20\">".$model->picOreginal->original_name."</span></div>"; ?>
            <?php endif; ?>
            </div>
            <div class="col col-lg-2" style="float: right;top: -65px;left: -150px;">
                <?php if ( trim($model->pic_oreginal_id) <> "" ) : ?>
                    <?php // echo Html::button('Удалить', array( 'onclick'=>"$('#pic_anons #ytIblocks_picOreginal').val('');$('#pic_oreginal #Iblocks_picOreginal').val('');$('#Iblocks_pic_anons_id').val('');" )); ?>
                    <?php if ( trim( $model->pic_oreginal_id ) <> trim( $model->pic_anons_id ) ) { ?>
                    <?php $picAnons = '/'.str_replace('_original_small'.substr($model->picAnons->original_name,-4,4),
                                '_small'.substr($model->picAnons->original_name,-4,4),
                                $model->picAnons->original_name);
                    ?>
                    <?php } else { ?>
                    <?php $picOreginal = '/'.str_replace('_original'.substr($model->picOreginal->original_name,-4,4),
                                '_small'.substr($model->picOreginal->original_name,-4,4),
                                $model->picOreginal->original_name);
                    ?>
                    <?php } ?>
                    <div id="iblock-pic-oreginal" class="iblock-pic pos-r" >
                        <div class="pic pos-r">
                            <?php if ( trim( $model->pic_oreginal_id ) <> trim( $model->pic_anons_id ) ) { ?>
                            <?php
                                echo Html::a(Html::img( $picAnons , array('title'=>$model->picAnons->name, 'style'=>"padding-left:10px;vertical-align:middle")),
                                '/'.$model->picAnons->original_name,
                                array('class'=>'fancyImage'));
                            ?>
                            <?php } else { ?>
                            <?php
                                echo Html::a(Html::img( $picOreginal , array('title'=>$model->picOreginal->name, 'style'=>"padding-left:10px;vertical-align:middle")),
                                    '/'.$model->picOreginal->original_name,
                                    array('class'=>'fancyImage'));
                            ?>
                            <?php } ?>
                            <div class="del-pic btn btn-default btn-xs" style="position: absolute;top: 3px; margin-left: -24px;">
                                <?php
                                echo Html::a('x', 'javascript:void();', array("id"=>'del_pic_oreginal', "onclick"=>"$('#iblock-pic-oreginal').remove();$('#Iblocks_pic_oreginal_id').remove();"));
                                /*echo Chtml::ajaxLink('x',
                                                     '/bax.php/iblocks/ajaxdeletepicoreginal',
                                                     array(), // Свойства ajax
                                                     array("id"=>'del_pic_oreginal'));*/
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="clear" ></div>
            </div>
        </div>
        <div id="pic_scr" class="row <?=( $model->is_resize || $model->is_resize===null ? 'hidden' : '');?>">
            <div class="col">
            <?php echo $form->field($model,'picScr',['template' => "{label}\n<div class='col-sm-2 col-md-4'>{input}</div><div class='col-sm-2 col-md-4'>".Html::button('Очистить', array( 'class'=>'btn btn-primary', 'onclick'=>"$('#pic_scr #ytIblocks_picScr').val('');$('#pic_scr #Iblocks_picScr').val('');" ))."</div>\n{hint}\n{error}",
                    'labelOptions' => ['class'=> 'control-label col-sm-2' ],
                    'options' => ['class'=>'form-group m-b5' ]]
            )->fileInput(['class'=>'btn btn-default'])->label(Yii::t('label/all','Pic Scr'))->error(); ?>
            <?php if ( trim($model->pic_scr_id)<>"" ) : ?>
                  <?php  echo "<div class=\"col-sm-2\">&nbsp;</div>"; ?>
                  <?php  echo "<div class=\"col-sm small\"><span class=\"m-l20\">".$model->picScr->original_name."</span></div>"; ?>
            <?php endif; ?>
            <?php // echo Html::button('Удалить', array( 'onclick'=>"$('#pic_scr #ytIblocks_picScr').val('');$('#pic_scr #Iblocks_picScr').val('');$('#pic_scr_id').val('');" )); ?>
            </div>
            <div class="col col-lg-2" style="float: right;top: -65px;left: -150px;">
                <?php if ( trim($model->pic_scr_id)<>"" ) : ?>
                    <?php if ( strpos($model->picScr->original_name, '_scr') === false ) { ?>
                        <?php if ( strpos($model->picScr->original_name, '_big') === false ) { ?>
                            <?php if ( strpos($model->picScr->original_name, '_small') === false ) { ?>
                                <?php $picScr = '/'.str_replace('_original'.substr($model->picScr->original_name,-4,4),
                                        '_scr'.substr($model->picScr->original_name,-4,4),
                                        $model->picScr->original_name);
                                ?>
                                <?php } else { ?>
                                    <?php $picScr = '/'.str_replace('_original_big'.substr($model->picScr->original_name,-4,4),
                                            '_scr'.substr($model->picScr->original_name,-4,4),
                                            $model->picScr->original_name);
                                    ?>
                                <?php } ?>
                        <?php } else { ?>
                            <?php $picScr = '/'.str_replace('_original_small'.substr($model->picScr->original_name,-4,4),
                                    '_scr'.substr($model->picScr->original_name,-4,4),
                                    $model->picScr->original_name);
                            ?>
                        <?php } ?>
                    <?php } else { ?>
                        <?php $picScr = '/'.str_replace('_original_scr'.substr($model->picScr->original_name,-4,4),
                                '_scr'.substr($model->picScr->original_name,-4,4),
                                $model->picScr->original_name);
                        ?>
                    <?php } ?>
                    <div id="iblock-pic-scr" class="iblock-pic">
                        <?php /*<div class="pic">*/ ?>
                        <div class="pic pos-r">
                            <?php
                            echo Html::a(Html::img( $picScr,
                                array('title'=>$model->picScr->name,
                                    'style'=>"padding-left:10px;vertical-align:middle")),
                                '/'.$model->picScr->original_name,
                                array('class'=>'fancyImage'));
                            ?>
                            <?php /*<div class="del-pic btn btn-default btn-xs" style="position: absolute;top: 3px;right: 59px;">*/ ?>
                            <div class="del-pic btn btn-default btn-xs" style="position: absolute;top: 3px;margin-left:-24px;">
                                <?php
                                    echo Html::a('x', 'javascript:void();', array("id"=>'del_pic_src', "onclick"=>"$('#iblock-pic-scr').remove();$('#Iblocks_pic_scr_id').remove();"));
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="clear" ></div>
            </div>
        </div>
    </div>
    <?php /* End Main of tabs   the infoblock */ $ib_main = ob_get_contents(); ob_end_clean(); ?>

    <?php /* Begin Anons of tabs the infoblock */ ob_start(); ?>
    <div class="tabs" >
        <div class="row">
            <?= $form->field($model, 'anons', [
                    'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                    'labelOptions' => ['class'=> 'control-label col-sm-2' ]
                ])->textarea(['rows' => 6, 'style'=>'height: 74px;width: 400px;vertical-align:middle;margin:0;'/*,'maxlength'=>450*/])->error() ?>
        </div>
        <div id="pic_anons" class="row <?=( $model->is_resize || $model->is_resize===null ? 'hidden' : '');?>">
                <div class="col">
                    <?php echo $form->field($model,'picAnons', [
                            'template' => "{label}\n<div class='col-sm-2 col-md-4'>{input}</div><div class='col-sm-2 col-md-4'>"
                                .Html::button('Очистить', array( 'class'=>'btn btn-primary','onclick'=>"$('#pic_anons #ytIblocks_picAnons').val('');$('#pic_anons #Iblocks_picAnons').val('');" ))
                                //.Html::button('Удалить', array( 'class'=>'btn btn-primary','onclick'=>"$('#pic_anons #ytIblocks_picAnons').val('');$('#pic_anons #Iblocks_picAnons').val('');$('#pic_anons_id').val('');" ))
                                ."</div>\n{hint}\n{error}",
                            'labelOptions' => ['class'=> 'control-label col-sm-2' ],
                            'options' => ['class'=>'form-group m-b5' ]]
                    )->fileInput(['class'=>'btn btn-default'])->label(Yii::t('label/all','Pic Anons'))->error(); ?>
                    <?php if ( trim($model->pic_anons_id)<>"" ) : ?>
                        <?php  echo "<div class=\"col-sm-2\">&nbsp;</div>"; ?>
                        <?php  echo "<div class=\"col-sm small\"><span class=\"m-l20\">".$model->picAnons->original_name."</span></div>"; ?>
                    <?php endif; ?>
                </div>
                <div class="col col-lg-2" style="float: right;top: -80px;left: -150px;">
                    <?php if ( trim($model->pic_anons_id)<>"" ) : ?>
                    <?php if ( strpos($model->picAnons->original_name, '_original_small') === false ) { ?>
                            <?php if ( strpos($model->picAnons->original_name, '_original_scr') === false ) { ?>
                                <?php if ( strpos($model->picAnons->original_name, '_original_big') === false ) { ?>
                                <?php $picAnons = '/' . str_replace('_original' . substr($model->picAnons->original_name, -4, 4),
                                        '_small' . substr($model->picAnons->original_name, -4, 4),
                                        $model->picAnons->original_name);
                                ?>
                                <?php } else { ?>
                                    <?php $picAnons = '/' . str_replace('_original_big' . substr($model->picAnons->original_name, -4, 4),
                                            '_small' . substr($model->picAnons->original_name, -4, 4),
                                            $model->picAnons->original_name);
                                    ?>
                                <?php } ?>
                            <?php } else { ?>
                                <?php $picAnons = '/' . str_replace('_original_scr' . substr($model->picAnons->original_name, -4, 4),
                                        '_small' . substr($model->picAnons->original_name, -4, 4),
                                        $model->picAnons->original_name);
                                ?>
                            <?php } ?>
                    <?php } else { ?>
                            <?php $picAnons = '/'.str_replace('_original_small'.substr($model->picAnons->original_name,-4,4),
                                    '_small'.substr($model->picAnons->original_name,-4,4),
                                    $model->picAnons->original_name);
                            ?>
                    <?php } ?>
                        <div id="iblock-pic-anons" class="iblock-pic pos-r">
                            <div class="pic pos-r">
                                <?php
                                echo Html::a(Html::img( $picAnons,'',
                                    array('title'=>$model->picAnons->name,
                                        'style'=>"padding-left:10px;vertical-align:middle")),
                                    '/'.$model->picAnons->original_name,
                                    array('class'=>'fancyImage'));
                                ?>
                                <div class="del-pic btn btn-default btn-xs" style="position: absolute;top: 3px;margin-left: -24px;" >
                                    <?php
                                    echo Html::a('x', 'javascript:void();', array("id"=>'del_pic_anons', "onclick"=>"$('#iblock-pic-anons').remove();$('#Iblock_pic_anons_id').remove();"));
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="clear" ></div>
                </div>
            </div>
    </div>
    <?php /* End Anons of tabs   the infoblock */ $ib_anons = ob_get_contents(); ob_end_clean(); ?>

    <?php /* Begin Detile of tabs the infoblock */ ob_start(); ?>
    <div class="tabs" >
        <div class="row editor detile" style="padding-top:10px;">
            <center class="plashka" ></center>
            <div>
                <?php echo $form->field($model,'detile', [
                        'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                        'labelOptions' => ['class'=> 'control-label col-sm-2' ]
                    ])->widget( CKEditor::className(),[
                    'editorOptions' => [
                        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                        'inline' => false, //по умолчанию false
                    ],
                ])->error(); ?>
                <?php // echo $form->textArea($model,'detile',array('rows'=>6, 'cols'=>50)); ?>
            </div>
        </div>
        <div id="pic_detile" class="row <?=( $model->is_resize || $model->is_resize===null ? 'hidden' : '');?> m-t21" >
            <div class="col">
                <?php echo $form->field($model,'picDetile', [
                        'template' => "{label}\n<div class='col-sm-2 col-md-4'>{input}</div><div class='col-sm-2 col-md-4'>"
                            .Html::button('Очистить', array( 'class'=>'btn btn-primary','onclick'=>"$('#pic_detile #ytIblocks_picDetile').val('');$('#pic_detile #Iblocks_picDetile').val('');" ))
                            //.Html::button('Удалить', array( 'class'=>'btn btn-primary','onclick'=>"$('#pic_detile #ytIblocks_picDetile').val('');$('#pic_detile #Iblocks_picDetile').val('');$('#pic_detile_id').val('');" ))
                            ."</div>\n{hint}\n{error}",
                        'labelOptions' => ['class'=> 'control-label col-sm-2' ],
                        'options' => ['class'=>'form-group m-b5' ]]
                )->fileInput(['class'=>'btn btn-default'])->label(Yii::t('label/all','Pic Anons'))->error(); ?>
                <?php if ( trim($model->pic_oreginal_id)<>"" ) : ?>
                    <?php  echo "<div class=\"col-sm-2\">&nbsp;</div>"; ?>
                    <?php  echo "<div class=\"col-sm small\"><span class=\"m-l20\">".$model->picOreginal->original_name."</span></div>"; ?>
                <?php endif; ?>
            </div>
            <?/*<div class="col col-lg-2" style="float: right;top: -80px;left: -150px;">*/?>
            <div class="row m-t10" >
                <?php  echo "<div class=\"col-sm-2\">&nbsp;</div>"; ?>
                <?php  echo "<div class=\"col-sm small\">" ?>
                <?php if ( strpos( $model->picDetile->original_name, '_big') === false ) { ?>
                    <?php if ( strpos( $model->picDetile->original_name, '_small') === false ) { ?>
                        <?php if ( strpos( $model->picDetile->original_name, '_scr') === false ) { ?>
                        <?php $picDetile = '/'.str_replace('_original'.substr($model->picDetile->original_name,-4,4),
                                '_big'.substr($model->picDetile->original_name,-4,4),
                                $model->picDetile->original_name); ?>
                        <?php } else { ?>
                            <?php $picDetile = '/'.str_replace('_original_scr'.substr($model->picDetile->original_name,-4,4),
                                    '_big'.substr($model->picDetile->original_name,-4,4),
                                    $model->picDetile->original_name); ?>
                        <?php } ?>
                    <?php } else { ?>
                        <?php $picDetile = '/'.str_replace('_original_small'.substr($model->picDetile->original_name,-4,4),
                                '_big'.substr($model->picDetile->original_name,-4,4),
                                $model->picDetile->original_name); ?>
                    <?php } ?>
                <?php } else { ?>
                    <?php $picDetile = '/'.str_replace('_original_big'.substr($model->picDetile->original_name,-4,4),
                            '_big'.substr($model->picDetile->original_name,-4,4),
                            $model->picDetile->original_name); ?>
                <?php } ?>
                <?php if ( trim($model->pic_detile_id)<>"" ) : ?>
                    <div id="iblock-pic-detile" class="iblock-pic pos-r">
                        <div class="pic">
                            <?php
                            echo Html::a(Html::img( $picDetile, array('title'=>$model->picDetile->name,
                                'style'=>"padding-left:10px;vertical-align:middle;")),
                                '/'.$model->picDetile->original_name,
                                array('class'=>'fancyImage'));
                            ?>
                        </div>
                        <div class="del-pic btn btn-default btn-xs" style="position: absolute;top: 3px;left:100%;margin-left:calc(-20% + 59px)" >
                            <?php
                            echo Html::a('x', 'javascript:void();', array("id"=>'del_pic_detile', "onclick"=>"$('#iblock-pic-detile').remove();$('#Iblocks_pic_detile_id').remove();"));
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php echo "</div>"; ?>
                <?php $script = <<< JS
                      $(".fancyImage").fancybox({'overlayShow': true, 'hideOnContentClick': false});
JS;
?>
                <?php $this->registerJs( $script, View::POS_READY, 'my-fancy-image' );
                ?>
            </div>
            <div class="clear" ></div>
        </div>
        <div class="clear" ></div>
    </div>
    <?php /* End Detile of tabs   the infoblock */ $ib_detile = ob_get_contents(); ob_end_clean(); ?>

    <?php /* Begin SEO of tabs the infoblock */ ob_start(); ?>
    <div class="tabs" >
        <div class="row">
            <?php echo $form->field($model,'title', [
                    'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                    'labelOptions' => ['class'=> 'control-label col-sm-2' ]])->textInput(array('style'=>'width:380px','size'=>60,'maxlength'=>255,
                    'onfocus'=>''))->error();/*"var title=$('#Iblocks_title').val();
                                        if (title.length()===0) { ".*//*Html::ajax( array(
                    'url'=>Yii::app()->createUrl('iblocks/genTitle'),
                    'type'=>'POST',
                    'dataType'=>'json',
                    'data'=>'js:$("#iblocks-form").serialize()',
                    'beforeSend'=>'function(){   
                                                                    var title=$("#Iblocks_title").val();
                                                                    if (title.length>0) {
                                                                        return false;
                                                                    }                                                                        
                                                                     //$("#myDiv").addClass("loading");
                                                                }',
                    'complete' => 'function(){                                                                       
                                                                     //$("#loadTitle").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                    //'update'=>'#loadCity',
                    'success' => "js:function(data){                                                                     
                                                                    $('#Iblocks_title').val(data.content); 
                                                                 }"
                )/*."} else { return false; }"*/
                //)))->error(); ?>
        </div>
        <div class="row">
               <?php echo $form->field($model, 'keywords', [
                   'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                   'labelOptions' => ['class'=> 'control-label col-sm-2' ]
               ])->textArea(
                       array( 'style'=>'width:380px',
                               'rows'=>6,
                               'cols'=>50,
                            /*'onfocus'=>/*"var title=$('#Iblocks_title').val();
                                                    if (title.length()===0) { ".*//*Html::ajax( array(
                                'url'=>Yii::app()->createUrl('iblocks/genKeywords'),
                                'type'=>'POST',
                                'dataType'=>'json',
                                'data'=>'js:$("#iblocks-form").serialize()',
                                'beforeSend'=>'function(){   
                                                                    var desc=$("#Iblocks_keywords").val();
                                                                    if (desc.length>0) {
                                                                        return false;
                                                                    }                                                                        
                                                                     //$("#myDiv").addClass("loading");
                                                                }',*/
                    'complete' => 'function(){                                                                       
                                                                     //$("#loadDesc").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                    //'update'=>'#loadCity',
                    'success' => "js:function(data){                                                                     
                                                                    $('#Iblocks_keywords').val(data.content); 
                                                                 }"
                ))->error(); ?>
        </div>
        <div class="row">
            <?php echo $form->field($model,'description', [
                    'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                    'labelOptions' => ['class'=> 'control-label col-sm-2' ]
                ])->textarea( array('style'=>'width:380px','rows'=>6, 'cols'=>50,
                /*'onfocus'=>/*"var title=$('#Iblocks_title').val();
                                        if (title.length()===0) { ".*//*Html::ajax( array(
                    'url'=>Yii::app()->createUrl('iblocks/genDescription'),
                    'type'=>'POST',
                    'dataType'=>'json',
                    'data'=>'js:$("#iblocks-form").serialize()',
                    'beforeSend'=>'function(){   
                                                                    var desc=$("#Iblocks_description").val();
                                                                    if (desc.length>0) {
                                                                        return false;
                                                                    }                                                                        
                                                                     //$("#myDiv").addClass("loading");
                                                                }',*/
                    'complete' => 'function(){                                                                       
                                                                     //$("#loadDesc").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                    //'update'=>'#loadCity',
                    'success' => "js:function(data){                                                                     
                                                                    $('#Iblocks_description').val(data.content); 
                                                                 }"
                )/*."} else { return false; }"*/
                )->error(); ?>
        </div>
    </div>
    <?php /* End SEO of tabs   the infoblock */ $ib_seo = ob_get_contents(); ob_end_clean(); ?>

    <?php /* Begin App of tabs   the infoblock */ ob_start(); ?>
    <div class="tabs" >
        <div class="row">
            <?php echo $form->field($model,'del', [
                'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                'labelOptions' => ['class'=> 'control-label col-sm-2' ]
            ])->checkBox(array("class"=>"form-control", "style"=>"box-shadow:none;width:34px"),false)->error(); ?>
        </div>
        <div class="row">
            <?php if($model->datetime_start) {
                        $model->datetime_start = date("d.m.Y H:i", (integer) $model->datetime_start);
                    }
            echo $form->field($model, 'datetime_start', [
                'template' => "{label}\n<div class='col-sm-2 col-md-2'>{input}</div>\n{hint}\n{error}",
                'labelOptions' => ['class'=> 'control-label col-sm-2' ]
            ])->widget(
                    DateTimePicker::className(),
                    [   'name' => 'datetime_start',
                        'type' => DateTimePicker::TYPE_INPUT,
                        'options' => ['placeholder' => 'Ввод даты/времени...','size'=>8, 'style'=>'width: 168px;'],
                        'convertFormat' => true,
                        'value'=> date("d.m.Y h:i",(integer) $model->datetime_start),
                        'pluginOptions' => [
                            'format' => 'dd.MM.yyyy hh:i',
                            'autoclose'=>true,
                            'weekStart'=>1, //неделя начинается с понедельника
                            'startDate' => '01.05.2015 00:00', //самая ранняя возможная дата
                            'todayBtn'=>true, //снизу кнопка "сегодня"
                        ]
                    ])->error();

                   /* $langs = array_flip(Yii::app()->params->languages);

            if ($model->date_start)
                $model->date_start = date('d.m.Y',  strtotime($model->date_start))
            ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'language'=> $langs[Yii::app()->language],
                'model'=>$model,
                'attribute'=>'date_start',
                'theme'=>'ui-lightness',
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'dd.mm.yy',
                    'defaultDate'=>date('d.m.Y'),
                    'showButtonPanel'=>true,
                    'showOn'=> "button",
                    'buttonImage'=> "/images/calendar.gif",
                    'buttonImageOnly'=> true,
                    //set calendar z-index higher then UI Dialog z-index
                    'beforeShow'=>"js:function() {
                            $('.ui-datepicker').css('font-size', '0.8em');
                            $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                }",

                ),
                'htmlOptions'=>array('size'=>8 ),
            )); */?>
        </div>
        <div class="row">
            <?php if($model->datetime_end) {
                $model->datetime_end = date("d.m.Y H:i", (integer) $model->datetime_end);
            }
            echo $form->field($model, 'datetime_end', [
                'template' => "{label}\n<div class='col-sm-2 col-md-2'>{input}</div>\n{hint}\n{error}",
                'labelOptions' => ['class'=> 'control-label col-sm-2' ]
            ])->widget(
                DateTimePicker::className(),
                [   'name' => 'datetime_start',
                    'type' => DateTimePicker::TYPE_INPUT,
                    'options' => ['placeholder' => 'Ввод даты/времени...','size'=>8, 'style'=>'width: 168px;'],
                    'convertFormat' => true,
                    'value'=> date("d.m.Y h:i",(integer) $model->datetime_end),
                    'pluginOptions' => [
                        'format' => 'dd.MM.yyyy hh:i',
                        'autoclose'=>true,
                        'weekStart'=>1, //неделя начинается с понедельника
                        'startDate' => '01.05.2015 00:00', //самая ранняя возможная дата
                        'todayBtn'=>true, //снизу кнопка "сегодня"
                    ]
                ])->error();

                    /* $langs = array_flip(Yii::app()->params->languages);

             if ($model->date_end)
                 $model->date_end = date('d.m.Y',  strtotime($model->date_end))
             ?>
             <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                 'language'=> $langs[Yii::app()->language],
                 'model'=>$model,
                 'attribute'=>'date_end',
                 'theme'=>'ui-lightness',
                 'options'=>array(
                     'showAnim'=>'fold',
                     'dateFormat'=>'dd.mm.yy',
                     'defaultDate'=>date('d.m.Y'),
                     'showButtonPanel'=>true,
                     'showOn'=> "button",
                     'buttonImage'=> "/images/calendar.gif",
                     'buttonImageOnly'=> true,
                     //set calendar z-index higher then UI Dialog z-index
                     'beforeShow'=>"js:function() {
                             $('.ui-datepicker').css('font-size', '0.8em');
                             $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                 }",

                 ),
                 'htmlOptions'=>array('size'=>8 ),
             )); */?>
        </div>
        <?php /*<div class="row">
                    <?php echo $form->labelEx($model,'sid'); ?>
                    <?php echo $form->textField($model,'sid',array('style'=>'width:300px;','size'=>50,'maxlength'=>75)); ?>
                    <?php echo $form->error($model,'sid'); ?>
            </div>*/?>
        <?php /*<div class="row">
                    <?php echo $form->labelEx($model,'uid'); ?>
                    <?php echo $form->textField($model,'uid',array('style'=>'width:380px','size'=>60,'maxlength'=>75)); ?>
                    <?php echo $form->error($model,'uid'); ?>
            </div>*/?>
        <div class="row">
            <?php echo $form->field($model,'action', [
                'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                'labelOptions' => ['class'=> 'control-label col-sm-2' ]
            ])->textInput( array('style'=>'width:380px','size'=>60,'maxlength'=>255))->error(); ?>
        </div>
        <div class="row">
            <?php echo $form->field($model,'url', [
                'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                'labelOptions' => ['class'=> 'control-label col-sm-2' ]
            ])->textInput( array('style'=>'width:380px','size'=>60,'maxlength'=>255))->error(); ?>
        </div>
        <div class="row">
            <?php echo $form->field($model,'url_detile', [
                'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                'labelOptions' => ['class'=> 'control-label col-sm-2' ]
            ])->textInput( array('style'=>'width:380px','size'=>60,'maxlength'=>255))->error(); ?>
        </div>
        <div class="row">
            <?php echo $form->field($model,'url_list', [
                'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                'labelOptions' => ['class'=> 'control-label col-sm-2' ]
            ])->textInput( array('style'=>'width:380px','size'=>60,'maxlength'=>255))->error(); ?>
        </div>
        <?php /*<div class="row">
                    <?php echo $form->labelEx($model,'is_main'); ?>
                    <?php echo $form->checkBox($model,'is_main'); ?>
                    <?php echo $form->error($model,'is_main'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'is_pay'); ?>
                    <?php echo $form->checkBox($model,'is_pay'); ?>
                    <?php echo $form->error($model,'is_pay'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'is_arhiv'); ?>
                    <?php echo $form->checkBox($model,'is_arhiv'); ?>
                    <?php echo $form->error($model,'is_arhiv'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'is_use'); ?>
                    <?php echo $form->checkBox($model,'is_use'); ?>
                    <?php echo $form->error($model,'is_use'); ?>
            </div>*/?>
    </div>
    <? /* End App of tabs   the infoblock */  $ib_app = ob_get_contents(); ob_end_clean(); ?>

    <? /* Begin Dop of tabs   the infoblock */ ob_start(); ?>
    <div class="tabs" >
        <div class="row" >
            <?php echo $form->field($model,'country_id', [
                'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                'labelOptions' => ['class'=> 'control-label col-sm-2' ]
            ])->dropDownList(
                ArrayHelper::map( Countries::find("",
                    array("order"=>"sort"))->all(), 'id', 'name'), array('prompt'=>Yii::t('all/application','Select')."..."))->error(); ?>
        </div>
        <div class="row" >
            <?php echo $form->field($model,'city_id', [
                'template' => "{label}\n<div class='col-sm-10 col-md-8'>{input}</div>\n{hint}\n{error}",
                'labelOptions' => ['class'=> 'control-label col-sm-2' ]
            ])->dropDownList(
                ArrayHelper::map( Cities::find("",
                    array("order"=>"sort"))/*->all()*/, 'id', 'name'), array('prompt'=>Yii::t('all/application','Select')."..."))->error(); ?>
        </div>
        <?php /*<div class="row">
                    <?php echo $form->labelEx($model,'maps_id'); ?>
                    <?php echo $form->textField($model,'maps_id',array('size'=>60,'maxlength'=>75)); ?>
                    <?php echo $form->error($model,'maps_id'); ?>
            </div>*/?>
        <?php /*<div class="row">
                    <?php echo $form->labelEx($model,'createusers'); ?>
                    <?php// echo $form->textField($model,'createusers'); ?>
                    <?php echo $form->dropDownList($model,'createusers',
                           CHtml::listData( Users::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                             array("order"=>"sort")), 'id', 'username'), array('prompt'=>Yii::t('all','Select')."...")); ?>
                    <?php echo $form->error($model,'createusers'); ?>
            </div>
            <div class="row">
                    <?php// echo $form->labelEx($model,'createdate'); ?>
                    <?php echo $form->textField($model,'createdate'); ?>
                    <?php echo $form->error($model,'createdate'); ?>
           <?php echo $form->labelEx($model,'createdate'); ?>
            <?php $langs = array_flip(Yii::app()->params->languages);
                  if ($model->createdate)
                      $model->createdate = date('d.m.Y',  strtotime($model->createdate))
            ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> $langs[Yii::app()->language],
                    'model'=>$model,
                    'attribute'=>'createdate',
                    'theme'=>'ui-lightness',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy',
                        'defaultDate'=>date('d.m.Y'),
                        'showButtonPanel'=>true,
                        'showOn'=> "button",
			'buttonImage'=> "/images/calendar.gif",
			'buttonImageOnly'=> true,
                        //set calendar z-index higher then UI Dialog z-index
                        'beforeShow'=>"js:function() {
                            $('.ui-datepicker').css('font-size', '0.8em');
                            $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                }",

                     ),
                    'htmlOptions'=>array('size'=>8 ),
                )); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'updateusers'); ?>
                    <?php// echo $form->textField($model,'updateusers'); ?>
                    <?php echo $form->dropDownList($model,'updateusers',
                           CHtml::listData( Users::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                             array("order"=>"sort")), 'id', 'username'), array('prompt'=>Yii::t('all','Select')."...")); ?>
                    <?php echo $form->error($model,'updateusers'); ?>
            </div>
            <div class="row">
                    <?php// echo $form->labelEx($model,'updatedate'); ?>
                    <?php// echo $form->textField($model,'updatedate'); ?>
                    <?php echo $form->labelEx($model,'updatedate'); ?>
                    <?php $langs = array_flip(Yii::app()->params->languages);
                          if ($model->updatedate)
                              $model->updatedate = date('d.m.Y',  strtotime($model->updatedate))
                    ?>
                    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'language'=> $langs[Yii::app()->language],
                            'model'=>$model,
                            'attribute'=>'updatedate',
                            'theme'=>'ui-lightness',
                            'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'dd.mm.yy',
                                'defaultDate'=>date('d.m.Y'),
                                'showButtonPanel'=>true,
                                'showOn'=> "button",
                                'buttonImage'=> "/images/calendar.gif",
                                'buttonImageOnly'=> true,
                                //set calendar z-index higher then UI Dialog z-index
                                'beforeShow'=>"js:function() {
                                    $('.ui-datepicker').css('font-size', '0.8em');
                                    $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                        }",

                             ),
                            'htmlOptions'=>array('size'=>8 ),
                        )); ?>
                    <?php echo $form->error($model,'updatedate'); ?>
            </div> */?>
    </div>
    <?php /* End Dop of tabs   the infoblock */ $ib_dop = ob_get_contents(); ob_end_clean(); ?>

    <?php  echo Tabs::widget(
            [
                'id' => 'tabs',
                'items'=>[
                    ['label'=>Yii::t('all','Основное'), 'content'=>$ib_main,   'id'=>'iblock-main'],
                    ['label'=>Yii::t('all','Анонс'), 'content'=>$ib_anons,  'id'=>'iblock-anons'],
                    ['label'=>Yii::t('all','Детально'),  'content'=>$ib_detile, 'id'=>'iblock-detile'],
                    ['label'=>Yii::t('all','SEO'), 'content'=>$ib_seo,    'id'=>'iblock-seo'],
                    //['label'=>Yii::t('all','Управление'),  'content'=>$ib_app,    'id'=>'iblock-app'],
                    ['label'=>Yii::t('all','Дополнительно'), 'content'=>$ib_dop,    'id'=>'iblock-dop'],
                ],
                'options'=>array(
                    'collapsible'=>true,
                    'selected'=>0,
                ),
            ]
        );
    ?>
    <?php /*=$form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'pic_anons_id')->textInput() ?>

    <?= $form->field($model, 'pic_detile_id')->textInput() ?>

    <?= $form->field($model, 'act')->textInput() ?>

    <?= $form->field($model, 'del')->textInput() ?>

    <?= $form->field($model, 'createusers')->textInput() ?>

    <?= $form->field($model, 'createdate')->textInput() ?>

    <?= $form->field($model, 'updateusers')->textInput() ?>

    <?= $form->field($model, 'updatedate')->textInput() ?>

    <?= $form->field($model, 'detile')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'cid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_main')->textInput() ?>

    <?= $form->field($model, 'is_pay')->textInput() ?>

    <?= $form->field($model, 'is_arhiv')->textInput() ?>

    <?= $form->field($model, 'is_use')->textInput() ?>

    <?= $form->field($model, 'maps_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_detile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_list')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_id')->textInput() ?>

    <?= $form->field($model, 'visible')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'action')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pic_oreginal_id')->textInput() ?>

    <?= $form->field($model, 'pic_scr_id')->textInput() ?>

    <?= $form->field($model, 'nid')->textInput(['maxlength' => true]) */ ?>
    <div class="form-group">
        <?= $form->field($model,'pic_detile_id',[
            'template' => '{input}', // Leave only input (remove label, error and hint)
            'options' => [
                'tag' => false, // Don't wrap with "form-group" div
            ]])->hiddenInput()->label(false); ?>
        <?= $form->field($model,'pic_anons_id',[
            'template' => '{input}', // Leave only input (remove label, error and hint)
            'options' => [
                'tag' => false, // Don't wrap with "form-group" div
            ]])->hiddenInput()->label(false); ?>
        <?= $form->field($model,'pic_oreginal_id',[
            'template' => '{input}', // Leave only input (remove label, error and hint)
            'options' => [
                'tag' => false, // Don't wrap with "form-group" div
            ]])->hiddenInput()->label(false); ?>
        <?= $form->field($model,'pic_scr_id',[
            'template' => '{input}', // Leave only input (remove label, error and hint)
            'options' => [
                'tag' => false, // Don't wrap with "form-group" div
            ]])->hiddenInput()->label(false); ?>
        <?= $form->field($model,'uid',[
            'template' => '{input}', // Leave only input (remove label, error and hint)
            'options' => [
                'tag' => false, // Don't wrap with "form-group" div
            ]])->hiddenInput()->label(false); ?>
        <?= $form->field($model,'nid',[
            'template' => '{input}', // Leave only input (remove label, error and hint)
            'options' => [
                'tag' => false, // Don't wrap with "form-group" div
            ]])->hiddenInput()->label(false); ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('all/application', 'Create') : Yii::t('all/application', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style'=>'margin: 25px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
