<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "card_specification_items".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $value
 * @property int|null $card_specification_id
 */
class CardSpecificationItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card_specification_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_specification_id'], 'integer'],
            [['name', 'value'], 'string', 'max' => 255],
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
            'value' => 'Value',
            'card_specification_id' => 'Card Specification ID',
        ];
    }
}
