<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gpu_score_benchmark".
 *
 * @property int $id
 * @property int $gpu_id
 * @property int $bench_id
 * @property string $score
 * @property int|null $position
 */
class GpuScoreBenchmark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gpu_score_benchmark';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gpu_id', 'bench_id', 'score'], 'required'],
            [['gpu_id', 'bench_id', 'position'], 'integer'],
            [['score'], 'string', 'max' => 255],
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
            'bench_id' => 'Bench ID',
            'score' => 'Score',
            'position' => 'Position',
        ];
    }
}
