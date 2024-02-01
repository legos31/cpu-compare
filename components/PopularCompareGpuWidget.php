<?php

namespace app\components;

use app\models\Compare;
use yii\base\Widget;

class PopularCompareGpuWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $cpus = Compare::getDb()->cache(function () {
            return Compare::find()->where(['category_id' => 2])->orderBy('counter desc')->limit(9)->all();
        }, 86400);
        //$cpus = Compare::find()->where(['category_id' => 2])->orderBy('counter desc')->limit(9)->all();
        
        return $this->render('populargpu', [
            'cpus' => $cpus,
        ]);
    }

}
