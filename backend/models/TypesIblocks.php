<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "types_iblocks".
 *
 * @property int $id
 * @property int $grid Предок типа инфоблока
 * @property string $name Наименование типа инфоблока
 * @property string $desc Описание инфоблока
 * @property int $act Отметка активности
 * @property int $del Пометка удаления
 */
class TypesIblocks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'types_iblocks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['grid', 'act', 'del'], 'integer'],
            [['name', 'desc'], 'string', 'max' => 75],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'grid' => Yii::t('app', 'Предок типа инфоблока'),
            'name' => Yii::t('app', 'Наименование типа инфоблока'),
            'desc' => Yii::t('app', 'Описание инфоблока'),
            'act' => Yii::t('app', 'Отметка активности'),
            'del' => Yii::t('app', 'Пометка удаления'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return TypesIblocksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TypesIblocksQuery(get_called_class());
    }
}
