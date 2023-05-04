<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "raspisanie".
 *
 * @property int $id Ид.записи
 * @property int $grid Ид.группы
 * @property int $cid Ид.календаря
 * @property string $name Наименование события
 * @property string $date Дата
 * @property string $time Время события
 * @property string $desc Краткое описание
 * @property string $title SEO заголовок
 * @property string $description SEO описание
 * @property string $keywords SEO слова
 *
 * @property Raspisanie $gr
 * @property Raspisanie[] $raspisanies
 */
class Raspisanie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'raspisanie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['grid', 'cid', 'sort'], 'integer'],
            [['name', 'uid', 'date'], 'required'],
            [['date', 'time' ], 'safe'],
            [['desc'], 'string'],
            [['name', 'uid'], 'string', 'max' => 75],
            [['grid'], 'exist', 'skipOnError' => true, 'targetClass' => Raspisanie::className(), 'targetAttribute' => ['grid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
                    'id' => Yii::t('app/raspisanie', 'Ид.записи'),
                   'uid' => Yii::t('app/raspisanie', 'Уникальный Ид.'),
                  'grid' => Yii::t('app/raspisanie', 'Ид.группы'),
                   'cid' => Yii::t('app/raspisanie', 'Ид.календаря'),
                  'sort' => Yii::t('app/raspisanie', 'Сортировка'),
                  'name' => Yii::t('app/raspisanie', 'Наименование события'),
                  'date' => Yii::t('app/raspisanie', 'Дата'),
                  'time' => Yii::t('app/raspisanie', 'Время события'),
                  'desc' => Yii::t('app/raspisanie', 'Краткое описание'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGr()
    {
        return $this->hasOne(Raspisanie::className(), ['id' => 'grid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaspisanies()
    {
        return $this->hasMany(Raspisanie::className(), ['grid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUids()
    {
        return $this->hasOne(Uids::className(), [ 'uid' => 'uid' ]);
    }

    /**
     * {@inheritdoc}
     * @return RaspisanieQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RaspisanieQuery(get_called_class());
    }
}
