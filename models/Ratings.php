<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ratings".
 *
 * @property int $id
 * @property int|null $card_id
 * @property string|null $category
 * @property string|null $kuki
 */
class Ratings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ratings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_id'], 'integer'],
            [['value'], 'safe'],
            [['category', 'kuki'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'card_id' => 'Card ID',
            'category' => 'Category',
            'kuki' => 'Kuki',
        ];
    }
}
