<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $image
 * @property string|null $description
 * @property int|null $date
 * @property int|null $views
 * @property string|null $alias
 * @property int|null $category_id
 * @property string|null $body
 * @property string|null $meta_key
 * @property string|null $meta_desc
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'body', 'meta_key', 'meta_desc'], 'string'],
            [['date', 'views', 'category_id'], 'integer'],
            [['title', 'image', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'image' => 'Image',
            'description' => 'Description',
            'date' => 'Date',
            'views' => 'Views',
            'alias' => 'Alias',
            'category_id' => 'Category ID',
            'body' => 'Body',
            'meta_key' => 'Meta Key',
            'meta_desc' => 'Meta Desc',
        ];
    }

    public function getMidRate(){
        return PostRating::find()->where(['post_id' => $this->id])->average('value') ?? 0;
    }
}
