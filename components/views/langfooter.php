<?php

use yii\helpers\Url;
use yii\helpers\Html;

$nameLang = ['ko' => '한국어', 'en' => 'English', 'ru' => 'Русский', 'es' => 'Español', 'pt' => 'Português', 'pl' => 'Polski', 'fr' => 'Français', 'ja' => '日本語', 'zh-CN' => '中文', 'de' => 'Deutsch', 'it' => 'Italiano'];
$baseUrl = Url::base('https');
//$qs = Yii::$app->request->get();
echo '<ul class="languages">';

foreach ($arrLang as $lang) {
    echo '<li style="margin:5px">';

    if ($lang->code == 'en') {
        $link = $baseUrl . '/' . $url1;
        if (Yii::$app->language == $lang->code) {
            echo '<span class="active">' . $nameLang[$lang->code] . '</span>';
        } else {
            echo Html::a($nameLang[$lang->code], $link);
        }
    } else {
        $link = $baseUrl . '/' . $lang->code . '/' . $url1;
        if (Yii::$app->language == $lang->code) {
            echo '<span class="active">' . $nameLang[$lang->code] . '</span>';
        } else {
            echo Html::a($nameLang[$lang->code], $link);
        }
    }
    echo '</li>';
}
echo '<ul>';
?>
<style>
    .languages {
        display: flex;
        padding: 10px 0 10px;
        line-height: 17px;
        list-style: none;
        justify-content: space-between;
        color: white;
        flex-wrap: wrap;
        font-size: 0.75em;
    }

    .languages a {
        color: white;
    }

    .languages span.active {
        font-weight: 1000;
    }
</style>