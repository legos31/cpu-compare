<?php

namespace app\components;

use app\models\Gpu;
use yii\base\Widget;

class ReviewsGpuWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $cpus = Gpu::getDb()->cache(function () {
            return Gpu::find()->orderBy('last_view')->limit(8)->all();
        }, 86400);
       
        //$cpus = Gpu::find()->orderBy('last_view')->limit(8)->all();

        return $this->render('reviewsgpu', [
            'cpus' => $cpus,
        ]);
    }
}
