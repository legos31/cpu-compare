<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "card_total_score".
 *
 * @property int $id
 * @property string $cpu_id
 * @property string $brand_id
 * @property string $total_score
 * @property int $mobile
 * @property int $position
 */
class CardTotalScore extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card_total_score';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cpu_id', 'brand_id', 'total_score', 'mobile', 'position'], 'required'],
            [['mobile', 'position'], 'integer'],
            [['cpu_id', 'brand_id', 'total_score'], 'string', 'max' => 255],
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
            'brand_id' => 'Brand ID',
            'total_score' => 'Total Score',
            'mobile' => 'Mobile',
            'position' => 'Position',
        ];
    }

    public function getNext()
    {
        $totalScore = Self::find()->all();
        $total = count($totalScore);

        $arrIds =[];
        $selfId = $this->id;
        for ($i=1;$i<=4;$i++) {
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

    public function getCpu() {
        return $this->hasOne(Card::className(), ['id' => 'cpu_id']);
    }
}
