<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class LanguageFooterWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $url1 = Yii::$app->request->pathInfo;
        $arrLang = \app\models\Languages::find()->all();
        $get = Yii::$app->request->get();
        
        return $this->render('langfooter', [
            'url1' => $url1,
            'arrLang' => $arrLang,
            'get' => $get,
        ]);
    }
}
