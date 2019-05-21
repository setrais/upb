<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "agent_kinds".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $name
 *
 * @property AgentTypes $type
 */
class AgentKinds extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agent_kinds';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'name'], 'required'],
            [['type_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AgentTypes::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/agents', 'ID'),
            'type_id' => Yii::t('app/agents', 'Type ID'),
            'name' => Yii::t('app/agents', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(AgentTypes::className(), ['id' => 'type_id']);
    }
}
