<?php

namespace app\components;

use app\models\Compare;
use yii\base\Widget;

class LatestCompareWidget extends Widget
{
    public $category;
    
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if ($this->category === null) {

            $latests = Compare::getDb()->cache(function () {
                return Compare::find()->orderBy('date desc')->limit(15)->all();
            }, 86400);
            //$latests = Compare::find()->orderBy('date desc')->limit(15)->all();
        } else {

            $latests = Compare::getDb()->cache(function () {
                return Compare::find()->where(['category_id' => $this->category])->orderBy('date desc')->limit(15)->all();
            }, 86400);
            //$latests = Compare::find()->where(['category_id' => $this->category])->orderBy('date desc')->limit(15)->all();
        } 
        

        array_shift($latests);

        return $this->render('latest', [
            'latests' => $latests,
        ]);
    }

}
