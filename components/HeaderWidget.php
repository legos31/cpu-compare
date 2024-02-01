<?php

namespace app\components;

use app\models\Card;
use app\models\Gpu;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class HeaderWidget extends Widget
{
    public $active_tab = 'cpu';

    public function init()
    {
        $this->active_tab = \Yii::$app->controller->id;
        parent::init();
    }

    public function run()
    {
        $card1 = null;
        $card2 = null;
        $get = \Yii::$app->request->get();

        if (\Yii::$app->controller->id == 'cpu' && Yii::$app->controller->action->id == 'index') {
            $card1 = Card::find()->where(['alias' => Html::encode($get['alias'])])->select('name, image_mini, alias')->one();
        }

        if (\Yii::$app->controller->id == 'gpu' && Yii::$app->controller->action->id == 'index') {
            $card1 = Gpu::find()->where(['alias' => Html::encode($get['alias'])])->select('name, image_mini, alias')->one();
        }

        if (\Yii::$app->controller->id == 'cpu' && Yii::$app->controller->action->id == 'main') {
            if (isset($get['alias'])) {
                $card1 = Card::find()->where(['alias' => Html::encode($get['alias'])])->select('name, image_mini, alias')->one();
            }
            
        }

        if (\Yii::$app->controller->id == 'gpu' && Yii::$app->controller->action->id == 'main') {
            if (isset($get['alias'])) {
                $card1 = Gpu::find()->where(['alias' => Html::encode($get['alias'])])->select('name, image_mini, alias')->one();
            }
        }

        if (isset($get['vs'])) {
            $arr = explode('-vs-', $get['vs']);
            if ($this->active_tab == 'cpu') {
                $card1 = Card::find()->where(['alias' => Html::encode($arr[0])])->select('name, image_mini, alias')->one();
                $card2 = Card::find()->where(['alias' => Html::encode($arr[1])])->select('name, image_mini, alias')->one();
            } else {
                $card1 = Gpu::find()->where(['alias' => Html::encode($arr[0])])->select('name, image_mini, alias')->one();
                $card2 = Gpu::find()->where(['alias' => Html::encode($arr[1])])->select('name, image_mini, alias')->one();
            }
        }

        return $this->render('header', [
            'active_tab' => $this->active_tab,
            'card1' => $card1,
            'card2' => $card2,
        ]);
    }
}
