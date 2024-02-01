<?php

namespace app\components;

use app\models\CardTotalScore;
use yii\base\Widget;
use app\models\Card;

class SimilarCpuWidget extends Widget
{
	public $card_id;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $card = Card::getDb()->cache(function () {
            return Card::find()->where(['id' => $this->card_id])->one();
        },86400);
        //$card = Card::find()->where(['id' => $this->card_id])->one();

        $score = CardTotalScore::getDb()->cache(function () {
            return CardTotalScore::find()->where('cpu_id = :cpu_id', ['cpu_id' => $this->card_id])->one();
        },86400);
        //$score = CardTotalScore::find()->where('cpu_id = :cpu_id', ['cpu_id' => $this->card_id])->one();
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
                return $this->render('similarcpu', [
                    'results' => $result,
                    'card_name' => $card_name,
                ]);
            } else {
            }
        } else {
            if ($card) {
                $cards = Card::getDb()->cache(function () use ($card) {
                    return Card::find()->where(['hertz' => $card->hertz])->andWhere(['category' => $card->category])->limit(8)->all();
                },86400);
                //$cards = Card::find()->where(['hertz' => $card->hertz])->andWhere(['category' => $card->category])->limit(8)->all();
                if ($cards) {
                    return $this->render('similarcpu_1', [
                        'results' => $cards,
                        'card_name' => $card->name,
                    ]);
                }
            }
            
        }
        
    }
}
