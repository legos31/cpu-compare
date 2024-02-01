<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $code
 * @property string|null $icon
 */
class Languages extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'icon'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 10],
            [['file'], 'file', 'extensions' => 'png, jpg, svg']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'icon' => 'Icon',
            'file' => 'Icon',
        ];
    }

    public function upload()
    {
        if (file_exists($this->icon)  && !empty($this->file)) {
            unlink($this->icon);
        }
        $path = 'images/flags/' . $this->code . '.' . $this->file->extension;
        $this->file->saveAs($path);
        $this->file = null;
        $this->icon = '/' . $path;
    }
}
