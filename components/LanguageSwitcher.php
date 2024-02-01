<?php

namespace app\components;

use app\models\Languages;
use yii\base\Widget;
use Yii;

class LanguageSwitcher extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $langs = Languages::find()->all();
        $pathInfo = Yii::$app->request->pathInfo;
        $queryString = Yii::$app->request->queryString;
       
        return $this->render('language', [
            'langs' => $langs,
            'path' => $pathInfo,
            'queryString' => $queryString,
        ]);
    }
}