<?php

namespace app\components;

use app\models\Gpu;
use app\models\Card;
use app\modules\admin\models\Banners;
use yii\base\Widget;

class HorizontalBannerWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $banner = Banners::find()->where(['type' => 'horizontal'])->orderBy('rand()')->one();

        return $this->render('horizontal', [
            'banner' => $banner,
        ]);
    }
}
