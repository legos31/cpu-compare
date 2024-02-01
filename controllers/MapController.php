<?php

namespace app\controllers;

use app\models\Card;
use app\models\Compare;
use app\models\Gpu;
use yii\data\Pagination;

class MapController extends MainController
{
    public function actionIndex(){
        return $this->render('index');
    }

    public function actionCpuList(){
        $query = Card::find()->select('name, alias');

        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 50
        ]);
        $cpus = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('cpu', [
            'cpus' => $cpus,
            'pages' => $pages,
        ]);
    }

    public function actionCompare($category){
        $query = Compare::find()->where(['category_id' => (int)$category]);

        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 50
        ]);
        $cpus = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('compare', [
            'cpus' => $cpus,
            'pages' => $pages,
        ]);
    }

    public function actionGpuList(){
        $query = Gpu::find()->select('name, alias');

        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 50
        ]);
        $cpus = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('gpu', [
            'cpus' => $cpus,
            'pages' => $pages,
        ]);
    }
}