<?php

namespace app\models;

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

    public function getSpecification()
    {
        return $this->hasOne(Specification::className(), ['id' => 'specification_id']);
    }

    public function getItems()
    {
        return $this->hasMany(CardSpecificationItems::className(), ['card_specification_id' => 'id']);
    }

    public static function addNew($card_id, $specification_id) {
        $model = new self();
        $model->card_id = $card_id;
        $model->specification_id = $specification_id;
        $model->save();
        return $model;
    }
}
