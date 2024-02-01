<?php

namespace app\models;

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

    public function getSpecification()
    {
        $cb = CardSpecification::findOne($this->card_specification_id);
        return Specification::findOne($cb->specification_id);
    }

    public static function addNew($name, $value, $cs_id) {
        $csi = new self();
        $csi->name = rtrim($name, ':');
        $csi->value = $value;
        $csi->card_specification_id = $cs_id;
        $csi->save();
    }
}
