<?php

namespace app\components;

use app\models\GpuTotalScore;
use yii\base\Widget;
use app\models\Gpu;

class SimilarGpuWidget extends Widget
{
    public $card_id;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $card = Gpu::find()->where(['id' => $this->card_id])->one();
        $score = GpuTotalScore::find()->where('gpu_id = :gpu_id', ['gpu_id' => $this->card_id])->one();
        if ($score) {
            $nexts = $score->next;
            $prev = $score->prev;
            $result = array_merge($nexts, $prev);
            if ($card) {
                $card_name = $card->name;
            } else {
                $card_name = '';
            }
            if ($result) {
                return $this->render('similargpu', [
                    'results' => $result,
                    'card_name' => $card_name,
                ]);
            } else {
            }
        } else {
            if ($card) {
                $cards = Gpu::find()->where(['hertz' => $card->hertz])->andWhere(['!=', 'id', $card->id])->limit(8)->all();
                if ($cards) {
                    return $this->render('similargpu_1', [
                        'results' => $cards,
                        'card_name' => $card->name,
                    ]);
                }
            }
        }
    }
}
