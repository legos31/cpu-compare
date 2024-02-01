<?php

namespace app\components;

use app\models\Gpu;
use app\models\Card;
use app\modules\admin\models\Banners;
use yii\base\Widget;

class VerticalBannerWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $banner = Banners::find()->where(['type' => 'vertical'])->orderBy('rand()')->one();

        return $this->render('vertical', [
            'banner' => $banner,
        ]);
    }
}
