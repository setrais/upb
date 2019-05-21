<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\AgentKinds;
use backend\models\AgentTypes;
use backend\models\Agents;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AgentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/agents', 'Agents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agents-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app/agents', 'Create Agents'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            array( 'attribute' => 'id',
                'visible' => false
            ),
            array( 'attribute' => 'type_id',
                   'visible' => false
            ),
            array( 'attribute' => 'kind_id',
                   'value' => 'agentsKind.name',
                   'filter'=> ArrayHelper::map(AgentKinds::find()->asArray()->all(), 'id', 'name')

            ),
            array( 'attribute' => 'type_id',
                   'value' => 'agentsType.name',
                   'filter'=> ArrayHelper::map(AgentTypes::find()->asArray()->all(), 'id', 'name'),
            ),
            /*array( 'attribute' => 'agentKind',
                        'format' => 'raw',
                         'label' => 'Вид лица',
                       'options' => array( 'style' => 'text-align:left;width:180px;' ),
                         'value' => 'agentKinds.name',
                 'filterOptions' => function($model) {
                                        foreach ($model->agentKinds as $kind) {
                                            $kindNames[] = $kind->name;
                                        }
                                        return implode("\n", $kindNames);
                                    },
            'filterInputOptions' =>  ['class' => 'form-control', 'id' => null, 'prompt' => 'All'],
                 'headerOptions' => array('width'=>'180'),
                       'visible' => true,
            ),

            /*array( 'attribute' => 'type_id',
                         'label' => 'Тип лица',
                        'format' => 'text',
                       'options' => array( 'style' => 'text-align:left;width:180px;' ),
                         'value' => 'agentTypes.name',
                 'filterOptions' => ArrayHelper::map( AgentTypes::find()->all(), 'id', 'name'),
            'filterInputOptions' =>  ['class' => 'form-control', 'id' => null, 'prompt' => 'All'],
                 'headerOptions' => array('width'=>'180'),
                       'visible' => true,
            ),*/

            array( 'attribute' => 'fullname',
                  'label' => 'Наименование',
                   'format' => 'text',
                   'visible'=>true,
            ),
            // 'name',
            // 'f',
            // 'i',
            // 'o',
            array( 'attribute' => 'gender',
                'label' => 'Пол',
                'format' => 'text',
                'filter' => ['1' => 'мужской', '2' => 'женский'],
                'options' => array( 'style' => 'text-align:center;width:80px;' ),
                'value' => function ($model) { return ( $model->gender == '1' ? 'мужской' : ( $model->gender == '2' ? 'женский' : '')); },
                'headerOptions' =>array('width'=>'80','style'=>'text-align:center'),
                'visible'=>true,
            ),

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
