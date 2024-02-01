<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gpu_benchmark".
 *
 * @property int $id
 * @property int|null $gpu_id
 * @property int|null $benchmark_id
 */
class GpuBenchmark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gpu_benchmark';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gpu_id', 'benchmark_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gpu_id' => 'Gpu ID',
            'benchmark_id' => 'Benchmark ID',
        ];
    }

    public function getBenchmark()
    {
        return $this->hasOne(Benchmark::className(), ['id' => 'benchmark_id']);
    }

    public function getItems()
    {
        return $this->hasMany(GpuBenchmarkItems::className(), ['gpu_benchmark_id' => 'id'])->limit(4);
    }

    public static function addNew($card_id, $benchmark_id) {
        $cb = self::find()->where(['gpu_id' => $card_id, 'benchmark_id' => $benchmark_id])->one();
        if(!$cb){
            $cb = new self();
            $cb->gpu_id = $card_id;
            $cb->benchmark_id = $benchmark_id;
            $cb->save();
        }
        return $cb;
    }

    public function getItem()
    {
        return $this->hasMany(GpuBenchmarkItems::className(), ['gpu_benchmark_id' => 'id']);
    }
}
