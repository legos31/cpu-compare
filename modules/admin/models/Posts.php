<?php

namespace app\modules\admin\models;

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
 * @property string|null $meta_key
 * @property string|null $meta_desc
 * @property int|null $category_id
 * @property string|null $body
 */
class Posts extends \yii\db\ActiveRecord
{
    public $file;
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
            [['description', 'body', 'category_id', 'title'], 'required'],
            [['description', 'body', 'meta_key', 'meta_desc'], 'string'],
            [['date', 'views', 'category_id'], 'integer'],
            [['title', 'image', 'alias'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'png, jpg'],
            ['date', 'default', 'value' => time()],
            ['views', 'default', 'value' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'image' => 'Изоброжение',
            'description' => 'Описание',
            'date' => 'Дата',
            'views' => 'Просмотры',
            'alias' => 'Alias',
            'category_id' => 'Категория',
            'body' => 'Текст',
            'meta_desc' => 'Meta description',
            'meta_key' => 'Meta keywords',
        ];
    }

    public function beforeSave($insert)
    {
        $this->alias = createAlias($this->title);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function upload()
    {
        if ($this->validate() && $this->file) {
            if (file_exists($this->image)  && !empty($this->file)) {
                unlink($this->image);
            }
            $path = 'images/uploads/posts/' . uniqid(md5($this->file->baseName)) . '.' . $this->file->extension;
            $this->file->saveAs($path);
            $this->image = $path;
            $this->file = null;
            $this->save();
        } else {
            return false;
        }
    }

    public function getCategory()
    {
        return Category::findOne($this->category_id);
    }

    public function getCategoryName()
    {
        return $this->category->name ?? '';
    }
}