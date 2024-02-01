<?php

namespace app\components;

use app\models\Gpu;
use yii\base\Widget;
use yii\db\Expression;
use app\models\Compare;

class CompareSimilarGpuWidget extends Widget
{
    public $gpu1_id;
    public $gpu2_id;
    public $cur_url;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $gpu1 = Gpu::getDb()->cache(function () {
            return Gpu::find()->where(['id' => $this->gpu1_id])->one();
        }, 86400);
        //$gpu1 = Gpu::find()->where(['id' => $this->gpu1_id])->one();

        $gpu2 = Gpu::getDb()->cache(function () {
            return Gpu::find()->where(['id' => $this->gpu2_id])->one();
        }, 86400);
        //$gpu2 = Gpu::find()->where(['id' => $this->gpu2_id])->one();

        $compare1 = Compare::getDb()->cache(function () {
            return Compare::find()->where(['card_1' => $this->gpu1_id])->orwhere(['card_2' => $this->gpu1_id])->andwhere(['category_id' => 2])->limit(2)->all();
        }, 86400);
        //$compare1 = Compare::find()->where(['card_1' => $this->gpu1_id])->orwhere(['card_2' => $this->gpu1_id])->andwhere(['category_id' => 2])->limit(2)->all();

        $compare2 = Compare::getDb()->cache(function () {
            return Compare::find()->where(['card_1' => $this->gpu2_id])->orwhere(['card_2' => $this->gpu2_id])->andwhere(['category_id' => 2])->limit(2)->all();
        }, 86400);
        //$compare2 = Compare::find()->where(['card_1' => $this->gpu2_id])->orwhere(['card_2' => $this->gpu2_id])->andwhere(['category_id' => 2])->limit(2)->all();

        if (count($compare1) > 0) {
            $similar1 = $compare1;
        }

        if (count($compare2) > 0) {
            $similar2 = $compare2;
        }

        $similar = Gpu::getDb()->cache(function () use ($gpu1, $gpu2){
            return Gpu::find()
            ->orderBy(new Expression('rand()'))
            ->where(['type' => $gpu1->type])
            ->andWhere(['!=', 'id', $gpu1->id])
            ->andWhere(['!=', 'id', $gpu2->id])
            ->limit(2)
            ->all();
        }, 86400 );
        // $similar = Gpu::find()
        //     ->orderBy(new Expression('rand()'))
        //     ->where(['type' => $gpu1->type])
        //     ->andWhere(['!=', 'id', $gpu1->id])
        //     ->andWhere(['!=', 'id', $gpu2->id])
        //     ->limit(2)
        //     ->all();

        return $this->render('gpu', [
            'cpu1' => $gpu1,
            'cpu2' => $gpu2,
            'similar' => $similar,
            'similar1' => $similar1 ?? null,
            'similar2' => $similar2 ?? null,
            'cur_url' => $this->cur_url,
        ]);
    }
}
