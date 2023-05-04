<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "agent_types".
 *
 * @property integer $id
 * @property string $name
 *
 * @property AgentKinds[] $agentKinds
 * @property Agents[] $agents
 */
class AgentTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agent_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/agents', 'ID'),
            'name' => Yii::t('app/agents', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgentKinds()
    {
        return $this->hasMany(AgentKinds::className(), ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgents()
    {
        return $this->hasMany(Agents::className(), ['kind_id' => 'id']);
    }
}
