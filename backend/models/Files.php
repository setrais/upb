<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Files".
 *
 * @property integer $id
 * @property string $uid
 * @property string $status
 * @property string $name
 * @property string $timetamp_x
 * @property string $order
 * @property string $height
 * @property string $width
 * @property string $file_size
 * @property string $ext
 * @property string $subdir
 * @property string $file_name
 * @property string $original_name
 * @property string $content_type
 * @property string $module_id
 * @property string $handler_id
 * @property string $created_user
 * @property integer $updated_user
 * @property string $created
 * @property string $updated
 * @property string $description
 * @property string $action
 * @property string $controller
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'name', 'ext', 'original_name', 'created_user'], 'required'],
            [['status'], 'string'],
            [['timetamp_x', 'created', 'updated'], 'safe'],
            [['order', 'height', 'width', 'file_size', 'created_user', 'updated_user'], 'integer'],
            [['uid', 'content_type'], 'string', 'max' => 75],
            [['name', 'subdir', 'file_name', 'original_name', 'description', 'action', 'controller'], 'string', 'max' => 255],
            [['ext'], 'string', 'max' => 4],
            [['module_id', 'handler_id'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Ид.файла'),
            'uid' => Yii::t('app', 'Уникальный ID файла'),
            'status' => Yii::t('app', 'Статус файла'),
            'name' => Yii::t('app', 'Имя файла, присвоенное пользователем'),
            'timetamp_x' => Yii::t('app', 'Орегинальная дата создания файла'),
            'order' => Yii::t('app', 'Порядок'),
            'height' => Yii::t('app', 'Высота'),
            'width' => Yii::t('app', 'Ширина'),
            'file_size' => Yii::t('app', 'Размер файла'),
            'ext' => Yii::t('app', 'Расширение файла'),
            'subdir' => Yii::t('app', 'Путь к файлу'),
            'file_name' => Yii::t('app', 'Имя файла на диске'),
            'original_name' => Yii::t('app', 'Орегинальное имя файла'),
            'content_type' => Yii::t('app', 'Тип контента'),
            'module_id' => Yii::t('app', 'Ид.модуля'),
            'handler_id' => Yii::t('app', 'Ид.заголовка'),
            'created_user' => Yii::t('app', 'Ид.пользователя'),
            'updated_user' => Yii::t('app', 'Ид.пользователя внесшего изменения'),
            'created' => Yii::t('app', 'Дата создания картинки'),
            'updated' => Yii::t('app', 'Дата обновления картинки'),
            'description' => Yii::t('app', 'Описание'),
            'action' => Yii::t('app', 'Действие'),
            'controller' => Yii::t('app', 'Контроллер'),
        ];
    }

    /**
     * @inheritdoc
     * @return FilesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FilesQuery(get_called_class());
    }
}
