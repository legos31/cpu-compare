<?php

namespace app\components;

use app\models\Card;
use app\models\Gpu;
use yii\base\Widget;
use yii\db\Expression;
use app\models\Compare;
use Yii;

class CompareWidget extends Widget
{
    public $card_id;
    public $category;
    public $cur_url;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $title = '';
        if ($this->category == 1) {
            
            $card = Card::getDb()->cache(function () {
                return Card::find()->where(['id' => $this->card_id])->one();
            }, 86400);
            //$card = Card::find()->where(['id' => $this->card_id])->one();

            $title = Yii::t('app', 'Comparisons to this processor');
        } elseif ($this->category == 2) {

            $card = Gpu::getDb()->cache(function () {
                return Gpu::find()->where(['id' => $this->card_id])->one();
            }, 86400);
            //$card = Gpu::find()->where(['id' => $this->card_id])->one();

            $title = Yii::t('app', 'Comparisons to this graphics card');
        }

        // $compare = Compare::getDb()->cache(function () {
            // return Compare::find()->where(['card_1' => $this->card_id])->orwhere(['card_2' => $this->card_id])
            // ->andwhere(['category_id' => $this->category])->andwhere(['!=', 'url', $this->cur_url])->limit(4)->all();
        // }, 86400);
        $compare = Compare::find()->where(['card_1' => $this->card_id])->orwhere(['card_2' => $this->card_id])
            ->andwhere(['category_id' => $this->category])->andwhere(['!=','url', $this->cur_url])->limit(4)->all();

        if ($this->category == 1) {
            $similar = Card::getDb()->cache(function () use ($card){
                return Card::find()
                ->orderBy(new Expression('rand()'))
                ->where(['type' => $card->type, 'category' => $card->category])
                ->andWhere(['!=', 'id', $card->id])
                ->limit(4)
                ->all();
            }, 86400);
            // $similar = Card::find()
            // ->orderBy(new Expression('rand()'))
            // ->where(['type' => $card->type, 'category' => $card->category])
            // ->andWhere(['!=', 'id', $card->id])
            // ->limit(4)
            // ->all();
        } elseif ($this->category == 2) {
            $similar = Gpu::getDb()->cache(function () use ($card) {
                return Gpu::find()
                ->orderBy(new Expression('rand()'))
                ->where(['type' => $card->type])
                ->andWhere(['!=', 'id', $card->id])
                ->limit(4)
                ->all();
            }, 86400);
            // $similar = Gpu::find()
            // ->orderBy(new Expression('rand()'))
            // ->where(['type' => $card->type])
            // ->andWhere(['!=', 'id', $card->id])
            // ->limit(4)
            // ->all();
        }

        if ($this->category == 1) {
            return $this->render('compare', [
                'card' => $card,
                'compare' => $compare ?? null,
                'similar' => $similar ?? null,
                'title' => $title,
            ]);
        } else {
            return $this->render('comparegpu', [
                'card' => $card,
                'compare' => $compare ?? null,
                'similar' => $similar ?? null,
                'title' => $title,
            ]);
        }
        
       
    }
}
