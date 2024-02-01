<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $date
 * @property string|null $message
 * @property int|null $like
 * @property int|null $dislike
 * @property int|null $parent_id
 * @property string|null $blok
 * @property int|null $blok_id
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'date', 'like', 'dislike', 'parent_id', 'blok_id'], 'integer'],
            [['message'], 'string'],
            [['blok'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'date' => 'Date',
            'message' => 'Message',
            'like' => 'Like',
            'dislike' => 'Dislike',
            'parent_id' => 'Parent ID',
            'blok' => 'Blok',
            'blok_id' => 'Blok ID',
        ];
    }

    public function getUser(){
        return $this->hasOne(CommentUsers::className(), ['id' => 'user_id']);
    }
}
