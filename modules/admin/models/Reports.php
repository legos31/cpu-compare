<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "reports".
 *
 * @property int $id
 * @property string|null $text
 * @property string|null $link
 * @property string|null $page
 * @property int|null $new
 */
class Reports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['new'], 'integer'],
            [['link', 'page'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'link' => 'Link',
            'page' => 'Page',
            'new' => 'New',
        ];
    }
}
