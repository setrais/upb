<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "agents".
 *
 * @property integer $id
 * @property integer $kind_id
 * @property string $name
 * @property string $f
 * @property string $i
 * @property string $o
 * @property integer $gender
 * @property string $fullname
 *
 * @property AgentTypes $kind
 */
class Agents extends \yii\db\ActiveRecord
{
    public $type;
    public $kind;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kind_id', 'type_id'], 'required'],
            [['kind_id', 'gender', 'type_id'], 'integer'],
            [['name', 'type', 'kind', 'f', 'i', 'o', 'fullname'], 'string', 'max' => 255],
            [['kind_id'], 'exist', 'skipOnError' => true, 'targetClass' => AgentKinds::className(), 'targetAttribute' => ['kind_id' => 'id']],
            //[['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AgentTypes::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/agents', 'Ид.агента'),
            'kind_id' => Yii::t('app/agents', 'Ид.вида агента'),
            'type_id' => Yii::t('app/agents', 'Ид.типа агента'),
            'name' => Yii::t('app/agents', 'Наименование агента'),
            'f' => Yii::t('app/agents', 'Фамилия'),
            'i' => Yii::t('app/agents', 'Имя'),
            'o' => Yii::t('app/agents', 'Отчество'),
            'gender' => Yii::t('app/agents', 'Пол: 1 - мужской 2 - женский'),
            'type' => Yii::t('app/agents', 'Тип Лица'),
            'kind' => Yii::t('app/agents', 'Вид Лица'),
            'fullname' => Yii::t('app/agents', 'Полное наименование'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgentsKind()
    {
        return $this->hasOne(AgentKinds::className(), ['id' => 'kind_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgentsType()
    {
        return $this->hasOne(AgentTypes::className(), ['id' => 'type_id']);
    }
}
