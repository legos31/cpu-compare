<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "comment_users".
 *
 * @property int $id
 * @property string|null $kuki
 * @property string|null $image
 * @property string|null $name
 * @property string|null $email
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
            'name' => 'Name',
            'email' => 'Email',
        ];
    }
}
