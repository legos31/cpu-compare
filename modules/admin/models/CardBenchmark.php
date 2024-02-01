<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "card_benchmark".
 *
 * @property int $id
 * @property int|null $card_id
 * @property int|null $benchmark_id
 */
class CardBenchmark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card_benchmark';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_id', 'benchmark_id'], 'integer'],
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
            'benchmark_id' => 'Benchmark ID',
        ];
    }
}
