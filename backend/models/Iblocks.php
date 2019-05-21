<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "iblocks".
 *
 * @property integer $id
 * @property string $uid
 * @property integer $grid
 * @property string $name
 * @property string $sid
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $anons
 * @property integer $pic_anons_id
 * @property integer $pic_detile_id
 * @property integer $act
 * @property integer $del
 * @property integer $createusers
 * @property string $createdate
 * @property integer $updateusers
 * @property string $updatedate
 * @property string $detile
 * @property integer $sort
 * @property string $cid
 * @property integer $is_main
 * @property integer $is_pay
 * @property integer $is_arhiv
 * @property integer $is_use
 * @property string $maps_id
 * @property integer $types_iblocks_id
 * @property string $url
 * @property string $url_detile
 * @property string $url_list
 * @property integer $city_id
 * @property string $visible
 * @property string $action
 * @property integer $is_resize
 * @property integer $pic_oreginal_id
 * @property integer $pic_scr_id
 * @property string $nid
 *
 * @property Files $picScr
 * @property Files $picOreginal
 * @property Files $picAnons
 * @property Files $picDetile
 */
class Iblocks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iblocks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['grid', 'pic_anons_id', 'pic_detile_id', 'act', 'del', 'createusers', 'updateusers', 'sort', 'is_main', 'is_pay', 'is_arhiv', 'is_use', 'types_iblocks_id', 'city_id', 'is_resize', 'pic_oreginal_id', 'pic_scr_id'], 'integer'],
            [['keywords', 'description', 'anons', 'detile'], 'string'],
            [['createdate', 'updatedate'], 'safe'],
            [['uid', 'name', 'cid', 'maps_id', 'nid'], 'string', 'max' => 75],
            [['sid', 'title', 'url', 'url_detile', 'url_list', 'visible', 'action'], 'string', 'max' => 255],
            [['uid'], 'unique'],
            [['maps_id'], 'unique'],
            [['pic_scr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['pic_scr_id' => 'id']],
            [['pic_oreginal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['pic_oreginal_id' => 'id']],
            [['pic_anons_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['pic_anons_id' => 'id']],
            [['pic_detile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['pic_detile_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/iblock', 'ID'), // Record ID / Ид.записи'),
            'uid' => Yii::t('app/iblock', 'UID'), // Universal ID / Универсальный Ид.'),
            'grid' => Yii::t('app/iblock', 'GRID'), // Group ID / Ид.группы'),
            'name' => Yii::t('app/iblock', 'Name'), // Name / Название инфоблока (новости, раздела новостей, предложений, раздела предложений'),
            'sid' => Yii::t('app/iblock', 'SID'), // Simbol ID / Символьный Ид.'),
            'title' => Yii::t('app/iblock', 'SEO Title'), // SEO Title / Заголовкок SEO  (новостей, разделов, предложений и т.д.)'),
            'keywords' => Yii::t('app/iblock', 'SEO Keywords'), // SEO Keywords / Ключевые слова SEO'),
            'description' => Yii::t('app/iblock', 'SEO Description'), // SEO Description / Описание SEO'),
            'anons' => Yii::t('app/iblock', 'Anons'), // Anons / Анонс'),
            'pic_anons_id' => Yii::t('app/iblock', 'Img anons ID'), // Image anons ID / Ид.картинки анонса'),
            'pic_detile_id' => Yii::t('app/iblock', 'Img detile ID'), // Image detile ID / Ид.картинки детально'),
            'act' => Yii::t('app/iblock', 'Act'), // Mark activation / Пометка активации'),
            'del' => Yii::t('app/iblock', 'Del'), // Mark delete / Пометка удаления'),
            'createusers' => Yii::t('app/iblock', 'User Id'), // User ID create record / Ид.Пользователя создавшего запись'),
            'createdate' => Yii::t('app/iblock', 'Create date'), // Create Date / Дата создания'),
            'updateusers' => Yii::t('app/iblock', 'Update user'), // Update User / Пользователь обновившый запись'),
            'updatedate' => Yii::t('app/iblock', 'Update date'), // Update Date / Дата обновления'),
            'detile' => Yii::t('app/iblock', 'Detile info'), // Detile Info / Детальная информация'),
            'sort' => Yii::t('app/iblock', 'Sort'), // Sort / Сортировка'),
            'cid' => Yii::t('app/iblock', 'CID'), // Additionally propeties /  Дополнительные свойства ( props ->exts )'),
            'is_main' => Yii::t('app/iblock', 'Main'), // Mark view on main page / Пометка показывать на главной'),
            'is_pay' => Yii::t('app/iblock', 'Pay'), // Mark about pay / Пометка о покупке'),
            'is_arhiv' => Yii::t('app/iblock', 'Archive'), // Mark about moving in archive / Пометка об помещении в архив'),
            'is_use' => Yii::t('app/iblock', 'Used'), // Mark about using / Пометка об использовании'),
            'maps_id' => Yii::t('app/iblock', 'MID'), // Maps ID holding action / ID Карта проведения акции'),
            'types_iblocks_id' => Yii::t('app/iblock', 'TID'), // Type ID / Ид.типа'),
            'url' => Yii::t('app/iblock', 'Page url'), // Page Url / Url страницы или раздела'),
            'url_detile' => Yii::t('app/iblock', 'Detile url'), // Detile Url / Url детально'),
            'url_list' => Yii::t('app/iblock', 'List url'), // List Url / Url страницы списка'),
            'city_id' => Yii::t('app/iblock', 'Is city'), // Is City / Город к которому принадлежит'),
            'visible' => Yii::t('app/iblock', 'View status'), // View status / Статус отображения'),
            'action' => Yii::t('app/iblock', 'Action'), // Action / Действие'),
            'is_resize' => Yii::t('app/iblock', 'Resize status'), // Resize status / Статус Ресайза каринок'),
            'pic_oreginal_id' => Yii::t('app/iblock', 'Original image ID'), // Original images ID / Ид.орегинальной картинки'),
            'pic_scr_id' => Yii::t('app/iblock', 'Screen image ID'), // Screen images ID / eenИд.картинки скриншота'),
            'nid' => Yii::t('app/iblock', 'NID'), // Internal ID / Внутренний Ид'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPicScr()
    {
        return $this->hasOne(Files::className(), ['id' => 'pic_scr_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPicOreginal()
    {
        return $this->hasOne(Files::className(), ['id' => 'pic_oreginal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPicAnons()
    {
        return $this->hasOne(Files::className(), ['id' => 'pic_anons_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPicDetile()
    {
        return $this->hasOne(Files::className(), ['id' => 'pic_detile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Iblocks::className(), ['id' => 'grid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TypesIblocks::className(), ['id' => 'types_iblocks_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'createusers']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdateUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'updateusers']);
    }

    /**
     * @inheritdoc
     * @return IblocksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IblocksQuery(get_called_class());
    }
}
