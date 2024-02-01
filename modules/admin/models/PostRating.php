<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "post_rating".
 *
 * @property int $id
 * @property int|null $post_id
 * @property int|null $value
 * @property string|null $kuki
 */
class PostRating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'value'], 'integer'],
            [['kuki'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'value' => 'Value',
            'kuki' => 'Kuki',
        ];
    }
}
