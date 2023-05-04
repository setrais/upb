<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    public $roles;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['roles'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/iblock', 'ID'),
            'username' => Yii::t('app/iblock', 'Username'),
            'auth_key' => Yii::t('app/iblock', 'Auth Key'),
            'password_hash' => Yii::t('app/iblock', 'Password Hash'),
            'password_reset_token' => Yii::t('app/iblock', 'Password Reset Token'),
            'email' => Yii::t('app/iblock', 'Email'),
            'status' => Yii::t('app/iblock', 'Status'),
            'created_at' => Yii::t('app/iblock', 'Created At'),
            'updated_at' => Yii::t('app/iblock', 'Updated At'),
            'roles' => Yii::t('app/iblock', 'Roles'),
        ];
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
    }
}
