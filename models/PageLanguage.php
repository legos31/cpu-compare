<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "page_language".
 *
 * @property int $id
 * @property int|null $page_id
 * @property int|null $language_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $card_description
 */
class PageLanguage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page_language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_id', 'language_id'], 'integer'],
            [['description', 'card_description'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Page ID',
            'language_id' => 'Language ID',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }
}
