<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "card_benchmark_items".
 *
 * @property int $id
 * @property string|null $value
 * @property string|null $name
 * @property int|null $card_benchmark_id
 */
class CardBenchmarkItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card_benchmark_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_benchmark_id'], 'integer'],
            [['value', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'name' => 'Name',
            'card_benchmark_id' => 'Card Benchmark ID',
        ];
    }
}
