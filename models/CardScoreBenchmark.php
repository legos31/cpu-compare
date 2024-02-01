<?php

namespace app\models;

use Yii;
use app\models\Card;

/**
 * This is the model class for table "card_score_benchmark".
 *
 * @property int $id
 * @property int $cpu_id
 * @property int $bench_id
 * @property int $score
 * @property int|null $position
 */
class CardScoreBenchmark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card_score_benchmark';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cpu_id', 'bench_id', 'score'], 'required'],
            [['cpu_id', 'bench_id', 'score', 'position'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cpu_id' => 'Cpu ID',
            'bench_id' => 'Bench ID',
            'score' => 'Score',
            'position' => 'Position',
        ];
    }

    public function getCpu()
    {
        return $this->hasOne(Card::className(), ['id' => 'cpu_id']);
    }
}
