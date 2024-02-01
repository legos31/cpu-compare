<?php

namespace app\modules\admin\models;

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
}
