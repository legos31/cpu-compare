<?php

namespace app\models;

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
 * @property string|null $username
 * @property string|null $email
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
            [['like', 'dislike'], 'default', 'value' => 0]
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
            'username' => 'Name',
            'email' => 'E-mail',
            'blok' => 'Blok',
            'blok_id' => 'Blok ID',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(CommentUsers::className(), ['id' => 'user_id']);
    }

    public function addNew($comment, $user)
    {
        $this->message = $comment->message;
        $this->user_id = $user->id;
        $this->parent_id = $comment->parent_id;
        $this->blok = $comment->blok;
        $this->blok_id = $comment->blok_id;
        $this->date = time();
        return $this->save();
    }

    public function getChildren()
    {
        return self::find()->where(['parent_id' => $this->id])->all();
    }

    public function getLikeCount(){
        return Likedislike::find()->where(['comment_id' => $this->id, 'like' => 1])->count();
    }

    public function getDislikeCount(){
        return Likedislike::find()->where(['comment_id' => $this->id, 'like' => 0])->count();
    }
}
