<?php

namespace app\components;

use app\models\Card;
use yii\base\Widget;

class ReviewsCpuWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $cpus = Card::getDb()->cache(function () {
            return Card::find()->orderBy('last_view')->limit(8)->all();
        }, 86400);
        //$cpus = Card::find()->orderBy('last_view')->limit(8)->all();

        return $this->render('reviewscpu', [
            'cpus' => $cpus,
        ]);
    }
}
