<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "gpu_benchmark_items".
 *
 * @property int $id
 * @property string|null $value
 * @property string|null $name
 * @property int|null $gpu_benchmark_id
 */
class GpuBenchmarkItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gpu_benchmark_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gpu_benchmark_id'], 'integer'],
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
            'gpu_benchmark_id' => 'Gpu Benchmark ID',
        ];
    }
}
