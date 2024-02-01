<?php

namespace app\components;

use app\models\Gpu;
use app\models\Card;
use yii\base\Widget;

class ReviewsWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $cpus = Card::getDb()->cache(function () {
            return Card::find()->orderBy('last_view')->limit(4)->all();
        }, 86400);
        //$cpus = Card::find()->orderBy('last_view')->limit(4)->all();

        $gpus = Card::getDb()->cache(function () {
            return Gpu::find()->orderBy('last_view')->limit(4)->all();
        }, 86400);
        //$gpus = Gpu::find()->orderBy('last_view')->limit(4)->all();
        $all = array_merge(
            Card::find()->orderBy('last_view')->limit(2)->all(),
            Gpu::find()->orderBy('last_view')->limit(2)->all()
        );
        shuffle($all);

        return $this->render('reviews', [
            'cpus' => $cpus,
            'gpus' => $gpus,
            'all' => $all,
        ]);
    }
}
