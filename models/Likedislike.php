<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "likedislike".
 *
 * @property int $id
 * @property int|null $comment_id
 * @property int|null $like
 * @property string|null $kuki
 * @property string|null $section
 */
class Likedislike extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'likedislike';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment_id', 'like'], 'integer'],
            [['kuki', 'section'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment_id' => 'Comment ID',
            'like' => 'Like',
            'kuki' => 'Kuki',
            'section' => 'Section',
        ];
    }
}
