<?php

namespace app\components;

use app\models\Card;
use app\models\Compare;
use app\models\Gpu;
use yii\base\Widget;

class RecomendedWidget extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $cpus = Card::getDb()->cache(function () {
            return Card::find()->where(['recomend' => 1])->orderBy('rand()')->limit(4)->all();
        }, 86400);
        //$cpus = Card::find()->where(['recomend' => 1])->orderBy('rand()')->limit(4)->all();

        $gpus = Gpu::getDb()->cache(function () {
            return Gpu::find()->where(['recomend' => 1])->orderBy('rand()')->limit(4)->all();
        },86400);
        //$gpus = Gpu::find()->where(['recomend' => 1])->orderBy('rand()')->limit(4)->all();
        $cards = array_merge($cpus, $gpus);
        shuffle($cards);

        return $this->render('recomend', [
            'cards' => $cards,
        ]);
    }

}
