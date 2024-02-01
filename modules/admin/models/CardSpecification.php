<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "card_specification".
 *
 * @property int $id
 * @property int|null $card_id
 * @property int|null $specification_id
 */
class CardSpecification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card_specification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_id', 'specification_id'], 'integer'],
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
            'specification_id' => 'Specification ID',
        ];
    }
}
