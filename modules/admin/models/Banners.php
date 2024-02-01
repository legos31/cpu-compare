<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "banners".
 *
 * @property int $id
 * @property string|null $type
 * @property string|null $link
 * @property string|null $image
 * @property string|null $file
 * @property string|null $description
 * @property int|null $status
 */
class Banners extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['status'], 'integer'],
            [['type', 'link', 'image'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'png, jpg, svg, gif']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'link' => 'Link',
            'image' => 'Image',
            'file' => 'Image',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }

    public function upload()
    {
        if (file_exists($this->image)  && !empty($this->file)) {
            unlink($this->image);
        }
        $path = 'images/banners/' . createAlias($this->file->baseName) . uniqid() . '.' . $this->file->extension;
        $this->file->saveAs($path);
        $this->file = null;
        $this->image = '/' . $path;
    }
}
