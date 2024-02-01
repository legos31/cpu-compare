<?php

namespace app\components;

use yii\base\Widget;

class CookieWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $textCookie = \Yii::t('app','Our site uses cookies. By clicking, you agree to our');
        $textButton = \Yii::t('app', 'Accept');
        return $this->render('cookie', [
            'textCookie' => $textCookie,
            'textButton' => $textButton,
        ]);
    }
}
