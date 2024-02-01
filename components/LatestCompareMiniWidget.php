<?php

namespace app\components;

use app\models\Compare;
use yii\base\Widget;

class LatestCompareMiniWidget extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $latests = Compare::getDb()->cache(function () {
            return Compare::find()->orderBy('date desc')->limit(5)->all();
        }, 86400);
        //$latests = Compare::find()->orderBy('date desc')->limit(5)->all();

        array_shift($latests);

        return $this->render('latest_mini', [
            'latests' => $latests,
        ]);
    }

}
