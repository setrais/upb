<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property int $book_id
 * @property string $comment
 * @property int $rating
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'rating'], 'integer'],
            [['comment', 'rating'], 'required'],
            [['comment'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'comment' => 'Comment',
            'rating' => 'Rating',
        ];
    }
}
