<?php

namespace app\components;

use app\models\Compare;
use yii\base\Widget;

class PopularCompareWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $cpus = Compare::getDb()->cache(function () {
            return Compare::find()->where(['category_id' => 1])->orderBy('counter desc')->limit(6)->all();
        }, 86400);

        $gpus = Compare::getDb()->cache(function () {
            return Compare::find()->where(['category_id' => 2])->orderBy('counter desc')->limit(6)->all();
        }, 86400);

        // $cpus = Compare::find()->where(['category_id' => 1])->orderBy('counter desc')->limit(6)->all();
        // $gpus = Compare::find()->where(['category_id' => 2])->orderBy('counter desc')->limit(6)->all();

        return $this->render('popular', [
            'cpus' => $cpus,
            'gpus' => $gpus,
        ]);
    }

}
