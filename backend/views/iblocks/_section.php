<?php
use backend\models\Iblocks;
use backend\models\TypesIblocks;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<?php
    $data = ArrayHelper::map(
                Iblocks::find()->where("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0) ".( trim($model->types_iblocks_id)<>'' ? "AND (TYPES_IBLOCKS_ID='".$model->types_iblocks_id."')" : "")."AND ((GRID=0)OR(GRID IS NULL))",
                        array("order"=>"sort"))->asArray()->all(), 'id', 'name');
?>
<?php if (!empty($data)) { ?>
    <div class="form-group field-iblocks-grid has-success">
    <?php      echo Html::activeLabel($model,'grid', ['class'=> 'control-label col-sm-2' ] ); ?>
        <div class='col-sm-10 col-md-8'>
    <?php      echo Html::activeDropDownList($model,'grid',$data, ['class'=>'form-control']); ?>
        </div>
    <?php      echo Html::activeHint($model,'grid'); ?>
    <?php      echo Html::error($model,'grid'); ?>
    </div>
<?php } ?>
<script>    
    $('#Iblocks_action').val('<?=$model->action;?>');
    $('#Iblocks_url').val('<?=$model->url;?>');
    $('#Iblocks_url_detile').val('<?=$model->url_detile;?>');
    $('#Iblocks_url_list').val('<?=$model->url_list;?>');
</script>

