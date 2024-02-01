<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "card_benchmark_items".
 *
 * @property int $id
 * @property string|null $value
 * @property string|null $name
 * @property string|null $style
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
            [['value', 'name', 'style'], 'string', 'max' => 255],
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

    public function getBenchmark()
    {
        $cb = CardBenchmark::findOne($this->card_benchmark_id);
        return Benchmark::findOne($cb->benchmark_id);
    }

    public static function addNew($name, $card_benchmark_id, $pq) {
        try {
            $item = new self();
            $item->name = $name;
            $item->card_benchmark_id = $card_benchmark_id;
            $item->value = $pq->find('td:eq(2)>div')->text();
            $item->style = $pq->find('td:eq(2)>div')->attr('style');
            $item->save();
        }catch (\Exception $e) {}
    }
}
