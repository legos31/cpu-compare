<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gpu_total_score".
 *
 * @property int $id
 * @property string|null $gpu_id
 * @property string|null $brand_id
 * @property int|null $total_score
 * @property int|null $position
 */
class GpuTotalScore extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gpu_total_score';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total_score', 'position'], 'integer'],
            [['gpu_id', 'brand_id'], 'string', 'max' => 255],
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
            'brand_id' => 'Brand ID',
            'total_score' => 'Total Score',
            'position' => 'Position',
        ];
    }
    public function getNext()
    {
        $totalScore = Self::find()->all();
        $total = count($totalScore);

        $arrIds = [];
        $selfId = $this->id;
        for ($i = 1; $i <= 4; $i++) {
            if (($selfId + $i) > $total) continue;
            array_push($arrIds, $selfId + $i);
        }

        $next = Self::find()->where(['id' => $arrIds])->all();
        return $next;
    }
    public function getPrev()
    {
        $totalScore = Self::find()->all();
        $total = count($totalScore);

        $arrIds = [];
        $selfId = $this->id;
        for ($i = 1; $i <= 4; $i++) {
            if (($selfId - $i) > $total) continue;
            array_push($arrIds, $selfId - $i);
        }

        $prev = Self::find()->where(['id' => $arrIds])->all();
        return $prev;
    }

    public function getGpu()
    {
        return $this->hasOne(Gpu::className(), ['id' => 'gpu_id']);
    }
}
