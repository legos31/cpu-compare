<?php

namespace app\models;

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
            'gpu_benchmark_id' => 'Gpu Benchmark ID',
        ];
    }

    public function getBenchmark()
    {
        $cb = GpuBenchmark::findOne($this->gpu_benchmark_id);
        return Benchmark::findOne($cb->benchmark_id);
    }

    public static function addNew($gpu_benchmark_id, $pq) {
        try {
            $name = trim($pq->find('td:eq(1) a')->text());
            if($name && !self::find()->where(['name' => $name, 'gpu_benchmark_id' => $gpu_benchmark_id])->exists()){
                $item = new self();
                $item->name = trim($pq->find('td:eq(1) a')->text());
                $item->gpu_benchmark_id = $gpu_benchmark_id;
                $item->value = $pq->find('td:eq(2)>div')->text();
                $item->style = $pq->find('td:eq(2)>div')->attr('style');
                $item->save();
            }
        }catch (\Exception $e) {}
    }
}
