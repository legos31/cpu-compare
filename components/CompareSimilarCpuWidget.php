<?php

namespace app\components;

use app\models\Card;
use yii\base\Widget;
use yii\db\Expression;
use app\models\Compare;

class CompareSimilarCpuWidget extends Widget
{
    public $cpu1_id;
    public $cpu2_id;
    public $cur_url;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        // $cpu1 = Card::getDb()->cache(function () { 
        //     return Card::find()->where(['id' => $this->cpu1_id])->one();
        // }, 86400);
        $cpu1 = Card::find()->where(['id' => $this->cpu1_id])->one();

        // $cpu2 = Card::getDb()->cache(function () {
        //     return Card::find()->where(['id' => $this->cpu2_id])->one();
        // }, 86400 );
        $cpu2 = Card::find()->where(['id' => $this->cpu2_id])->one();

        // $compare1 = Compare::getDb()->cache(function () {
            // return Compare::find()->where(['card_1' => $this->cpu1_id])->orwhere(['card_2' => $this->cpu1_id])->andwhere(['category_id' => 1])->limit(2)->all();
        // }, 86400 );
        $compare1 = Compare::find()->where(['card_1' => $this->cpu1_id])->orwhere(['card_2' => $this->cpu1_id])->andwhere(['category_id' => 1])->limit(2)->all();

        // $compare2 = Compare::getDb()->cache(function () {
            // return Compare::find()->where(['card_1' => $this->cpu2_id])->orwhere(['card_2' => $this->cpu2_id])->andwhere(['category_id' => 1])->limit(2)->all();
        // }, 86400);
        $compare2 = Compare::find()->where(['card_1' => $this->cpu2_id])->orwhere(['card_2' => $this->cpu2_id])->andwhere(['category_id' => 1])->limit(2)->all();

        if (count($compare1) > 0) {
            $similar1 = $compare1;
        }

        if (count($compare2) > 0) {    
            $similar2 = $compare2;
        }

        // $similar = Card::getDb()->cache(function () use ($cpu1, $cpu2){
            // return Card::find()
            // ->orderBy(new Expression('rand()'))
            // ->where(['type' => $cpu1->type, 'category' => $cpu1->category])
            // ->andWhere(['!=', 'id', $cpu1->id])
            // ->andWhere(['!=', 'id', $cpu2->id])
            // ->limit(2)
            // ->all();
        // }, 86400);
        $similar = Card::find()
            ->orderBy(new Expression('rand()'))
            ->where(['type' => $cpu1->type, 'category' => $cpu1->category])
            ->andWhere(['!=', 'id', $cpu1->id])
            ->andWhere(['!=', 'id', $cpu2->id])
            ->limit(2)
            ->all();

        return $this->render('cpu', [
            'cpu1' => $cpu1,
            'cpu2' => $cpu2,
            'similar' => $similar,
            'similar1' => $similar1 ?? null,
            'similar2' => $similar2 ?? null,
            'cur_url' => $this->cur_url,
        ]);
    }
}
