<?php

namespace app\models;

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

    public function getBenchmark()
    {
        return $this->hasOne(Benchmark::className(), ['id' => 'benchmark_id']);
    }

    public function getItems()
    {
        return $this->hasMany(CardBenchmarkItems::className(), ['card_benchmark_id' => 'id']);
    }

    public static function addNew($card_id, $benchmark_id) {
        $cb = self::find()->where(['card_id' => $card_id, 'benchmark_id' => $benchmark_id])->one();
        if(!$cb){
            $cb = new self();
            $cb->card_id = $card_id;
            $cb->benchmark_id = $benchmark_id;
            $cb->save();
        }

        return $cb;
    }
}
