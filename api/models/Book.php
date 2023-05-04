<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 * @property int $year
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db');
    }

    public function getAuthors()
    {
        return $this->hasMany(Author::className(), ['id' => 'book_id'])
            ->viaTable('book_has_author', ['author_id' => 'id']);
    }

    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['book_id' => 'id']);
    }

    public function behaviors()
    {
        return
            [
                [
                    'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                    'relations' => [
                        'author_list' => ['authors'],
                        'review_list' => ['reviews'],
                    ]
                ]
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_list', 'review_list'], 'safe'],
            [['name', 'year'], 'required'],
            [['year'], 'integer'],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'year' => 'Year',
        ];
    }
}
