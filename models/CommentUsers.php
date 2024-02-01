<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment_users".
 *
 * @property int $id
 * @property string|null $kuki
 * @property string|null $image
 */
class CommentUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kuki', 'image', 'name', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kuki' => 'Kuki',
            'image' => 'Image',
        ];
    }
}
