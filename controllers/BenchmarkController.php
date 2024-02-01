<?php

namespace app\controllers;

use app\models\CardBenchmark;
use yii\data\ArrayDataProvider;
use app\models\CardScoreBenchmark;
use yii\data\Pagination;
use app\models\GpuScoreBenchmark;
use app\models\Card;
use app\models\CardTotalScore;
use app\models\GpuTotalScore;
use yii\helpers\ArrayHelper;
use Yii;
use app\models\CpuTotalScoreSearch;
use app\models\GpuTotalScoreSearch;
use yii\helpers\Url;

class BenchmarkController extends MainController
{
    // public function behaviors()
    // {
    //     return [

    //         'httpCache' => [
    //             'class' => 'yii\filters\HttpCache',
    //             'lastModified' => function ($action, $params) {
    //                 $ifModified = strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'] ?? '');
                   
    //                 $lastModified = time() - 259200;
    //                 if ($ifModified  && $ifModified >= $lastModified) {
    //                     Yii::$app->response->statusCode = 304;
    //                 }
    //                 return $lastModified;
    //             },

    //             'sessionCacheLimiter' => 'public',
    //             'cacheControlHeader' => 'public, max-age=3600',
    //         ],
    //     ];
    // }

    /**
     * {@inheritdoc}
     */

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionGeekbench5()
    {
        $title = 'Geekbench 5 processor performance rankings';
        $arrBenchmarkSingle =[];
        $benchmarksMulti = CardScoreBenchmark::getDb()->cache(function () {
            return CardScoreBenchmark::find()->where(['bench_id' => '110']);
        }, 86400);
        //$benchmarksMulti = CardScoreBenchmark::find()->where(['bench_id' => '110']);

        $benchmarksSingle = CardScoreBenchmark::getDb()->cache(function () {
            return CardScoreBenchmark::find()->where(['bench_id' => '109'])->asArray()->all();
        }, 86400);
        //$benchmarksSingle = CardScoreBenchmark::find()->where(['bench_id' => '109'])->asArray()->all();
        
        foreach ($benchmarksSingle as $elem) {
            $arrBenchmarkSingle[$elem['cpu_id']] = $elem['score'];
        }

        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('geekbench5', [
            'benchmarksMulti' => $elems,
            'benchmarksSingle' => $arrBenchmarkSingle,
            'pages' => $pages,
            'title' => $title,
        ]);
    }

    public function actionIgpu() {

        $title = 'IGPU - FP32 processor performance rankings';
        $benchmarksMulti = CardScoreBenchmark::getDb()->cache(function () {
            return CardScoreBenchmark::find()->where(['bench_id' => '112'])->orderBy(['position' => SORT_ASC]);
        }, 86400);
        //$benchmarksMulti = CardScoreBenchmark::find()->where(['bench_id' => '112'])->orderBy(['position' => SORT_ASC]);

        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('igpu', [
            'benchmarksMulti' => $elems,
            'pages' => $pages,
            'title' => $title,
        ]);

    }

    public function actionCinebenchr23()
    {
        $title = 'Cinebench R23 processor performance rankings';
        $arrBenchmarkSingle =[];

        $benchmarksMulti = CardScoreBenchmark::getDb()->cache(function () {
            return CardScoreBenchmark::find()->where(['bench_id' => '104']);
        }, 86400);
        //$benchmarksMulti = CardScoreBenchmark::find()->where(['bench_id' => '104']);

        $benchmarksSingle = CardScoreBenchmark::getDb()->cache(function () {
            return CardScoreBenchmark::find()->where(['bench_id' => '103'])->asArray()->all();
        }, 86400);
        //$benchmarksSingle = CardScoreBenchmark::find()->where(['bench_id' => '103'])->asArray()->all();

        foreach ($benchmarksSingle as $elem) {
            $arrBenchmarkSingle[$elem['cpu_id']] = $elem['score'];
        }

        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('cinebenchr23', [
            'benchmarksMulti' => $elems,
            'benchmarksSingle' => $arrBenchmarkSingle,
            'pages' => $pages,
            'title' => $title,
        ]);
    }

    public function actionCinebenchr20()
    {
        $title = 'Cinebench R20 processor performance rankings';
        $arrBenchmarkSingle =[];

        $benchmarksMulti = CardScoreBenchmark::getDb()->cache(function () {
            return CardScoreBenchmark::find()->where(['bench_id' => '106']);
        }, 86400);
        //$benchmarksMulti = CardScoreBenchmark::find()->where(['bench_id' => '106']);

        $benchmarksSingle = CardScoreBenchmark::getDb()->cache(function () {
            return CardScoreBenchmark::find()->where(['bench_id' => '105'])->asArray()->all();
        }, 86400);
        //$benchmarksSingle = CardScoreBenchmark::find()->where(['bench_id' => '105'])->asArray()->all();

        foreach ($benchmarksSingle as $elem) {
            $arrBenchmarkSingle[$elem['cpu_id']] = $elem['score'];
        }

        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('cinebenchr20', [
            'benchmarksMulti' => $elems,
            'benchmarksSingle' => $arrBenchmarkSingle,
            'pages' => $pages,
            'title' => $title,
        ]);
    }

    public function actionCinebenchr15()
    {
        $title = 'Cinebench R15 processor performance rankings';
        $arrBenchmarkSingle =[];
        
        $benchmarksMulti = CardScoreBenchmark::getDb()->cache(function () {
            return CardScoreBenchmark::find()->where(['bench_id' => '108']);
        }, 86400);
        //$benchmarksMulti = CardScoreBenchmark::find()->where(['bench_id' => '108']);

        $benchmarksSingle = CardScoreBenchmark::getDb()->cache(function () {
            return CardScoreBenchmark::find()->where(['bench_id' => '107'])->asArray()->all();
        }, 86400);
        //$benchmarksSingle = CardScoreBenchmark::find()->where(['bench_id' => '107'])->asArray()->all();
        foreach ($benchmarksSingle as $elem) {
            $arrBenchmarkSingle[$elem['cpu_id']] = $elem['score'];
        }

        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('cinebenchr15', [
            'benchmarksMulti' => $elems,
            'benchmarksSingle' => $arrBenchmarkSingle,
            'pages' => $pages,
            'title' => $title,
        ]);
    }

    public function actionPassmark() {

        $title = 'PassMark processor performance rankings';

        $benchmarksMulti = CardScoreBenchmark::getDb()->cache(function () {
            return CardScoreBenchmark::find()->where(['bench_id' => '120']);
        }, 86400);
        //$benchmarksMulti = CardScoreBenchmark::find()->where(['bench_id' => '120']);

        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('passmark', [
            'benchmarksMulti' => $elems,
            'pages' => $pages,
            'title' => $title,
        ]);

    }

    public function actionMonero() {

        $title = 'Monero processor performance rankings';

        $benchmarksMulti = CardScoreBenchmark::getDb()->cache(function () {
            return CardScoreBenchmark::find()->where(['bench_id' => '111']);
        }, 86400);
        //$benchmarksMulti = CardScoreBenchmark::find()->where(['bench_id' => '111']);

        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('monero', [
            'benchmarksMulti' => $elems,
            'pages' => $pages,
            'title' => $title,
        ]);

    }

    public function actionFp32() {

        $title = 'FP32 Performance GPU rankings';

        $benchmarksMulti = GpuScoreBenchmark::getDb()->cache(function () {
            return GpuScoreBenchmark::find()->where(['bench_id' => '121']);
        }, 86400);
        //$benchmarksMulti = GpuScoreBenchmark::find()->where(['bench_id' => '121']);
        
        // $sort = new \yii\data\Sort([
        //         'attributes' => [
        //             'age',
        //             'gpu_id' => [
        //                 'asc' => ['gpu_id' => SORT_ASC],
        //                 'desc' => ['gpu_id' => SORT_DESC],
        //                 'default' => SORT_DESC,
        //                 'label' => 'Name',
        //             ],
        //         ],
        //     ]);

        
        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            //->orderBy($sort->orders)
            ->all();

        return $this->render('fp32', [
            'benchmarksMulti' => $elems,
            'pages' => $pages,
            'title' => $title,
            //'sort' => $sort,
        ]);

    }

    public function action3dmark() {

        $title = '3DMark Benchmark Performance GPU rankings';

        $benchmarksMulti = GpuScoreBenchmark::getDb()->cache(function () {
            return GpuScoreBenchmark::find()->where(['bench_id' => '122']);
        }, 86400);
        //$benchmarksMulti = GpuScoreBenchmark::find()->where(['bench_id' => '122']);
        
        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('3dmark', [
            'benchmarksMulti' => $elems,
            'pages' => $pages,
            'title' => $title,
        ]);

    }

    public function actionBattlefield5() {

        $title = 'Battlefield 5 Performance GPU rankings';

        $benchmarksMulti = GpuScoreBenchmark::getDb()->cache(function () {
            return GpuScoreBenchmark::find()->where(['bench_id' => '123']);
        }, 86400);
        //$benchmarksMulti = GpuScoreBenchmark::find()->where(['bench_id' => '123']);
        
        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('battlefield5', [
            'benchmarksMulti' => $elems,
            'pages' => $pages,
            'title' => $title,
        ]);

    }

    public function actionShadowTombRaider() {

        $title = 'Shadow of the Tomb Raider performance GPU rankings';

        $benchmarksMulti = GpuScoreBenchmark::getDb()->cache(function () {
            return GpuScoreBenchmark::find()->where(['bench_id' => '124']);
        }, 86400);
        //$benchmarksMulti = GpuScoreBenchmark::find()->where(['bench_id' => '124']);
        
        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('tombraider', [
            'benchmarksMulti' => $elems,
            'pages' => $pages,
            'title' => $title,
        ]);

    }

    public function actionEthereum() {

        $title = 'Crypto-Mining Ethereum Hashrate (MH/s) performance GPU rankings';

        $benchmarksMulti = GpuScoreBenchmark::getDb()->cache(function () {
            return GpuScoreBenchmark::find()->where(['bench_id' => '125']);
        }, 86400);
        //$benchmarksMulti = GpuScoreBenchmark::find()->where(['bench_id' => '125']);
        
        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('ethereum', [
            'benchmarksMulti' => $elems,
            'pages' => $pages,
            'title' => $title,
        ]);

    }
    
    public function actionErgo() {

        $title = 'Crypto-Mining Ergo Hashrate (MH/s) performance GPU rankings';

        $benchmarksMulti = GpuScoreBenchmark::getDb()->cache(function () {
            return GpuScoreBenchmark::find()->where(['bench_id' => '126']);
        }, 86400);
        //$benchmarksMulti = GpuScoreBenchmark::find()->where(['bench_id' => '126']);
        
        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('ergo', [
            'benchmarksMulti' => $elems,
            'pages' => $pages,
            'title' => $title,
        ]);

    }

    public function actionRavencoin() {

        $title = 'Crypto-Mining Ravencoin Hashrate (MH/s) performance GPU rankings';

        $benchmarksMulti = GpuScoreBenchmark::getDb()->cache(function () {
            return GpuScoreBenchmark::find()->where(['bench_id' => '127']);
        }, 86400);
        //$benchmarksMulti = GpuScoreBenchmark::find()->where(['bench_id' => '127']);
        
        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('ravencoin', [
            'benchmarksMulti' => $elems,
            'pages' => $pages,
            'title' => $title,
        ]);

    }

    public function actionVertcoin() {

        $title = 'Crypto-Mining Vertcoin Hashrate (MH/s) performance GPU rankings';

        $benchmarksMulti = GpuScoreBenchmark::getDb()->cache(function () {
            return GpuScoreBenchmark::find()->where(['bench_id' => '128']);
        }, 86400);
        //$benchmarksMulti = GpuScoreBenchmark::find()->where(['bench_id' => '128']);
        
        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('vertcoin', [
            'benchmarksMulti' => $elems,
            'pages' => $pages,
            'title' => $title,
        ]);

    }
    
    public function actionIntel() {

       $title = 'Intel processor performance rankings';

        $benchmarksMulti = CardTotalScore::getDb()->cache(function () {
            return CardTotalScore::find()->where(['brand_id' => '1']);
        }, 86400);
       //$benchmarksMulti = CardTotalScore::find()->where(['brand_id' => '1']);

        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('intel', [
            'benchmarksMulti' => $elems,
            'pages' => $pages,
            'title' => $title,
        ]);

    }
    
    public function actionAmd() {

       $title = 'AMD processor performance rankings';

        $benchmarksMulti = CardTotalScore::getDb()->cache(function () {
            return CardTotalScore::find()->where(['brand_id' => '2']);
        }, 86400);
       //$benchmarksMulti = CardTotalScore::find()->where(['brand_id' => '2']);

        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('amd', [
            'benchmarksMulti' => $elems,
            'pages' => $pages,
            'title' => $title,
        ]);

    }
    
    public function actionApple() {

       $title = 'AMD processor performance rankings';

        $benchmarksMulti = CardTotalScore::getDb()->cache(function () {
            return CardTotalScore::find()->where(['brand_id' => '3']);
        }, 86400);
       //$benchmarksMulti = CardTotalScore::find()->where(['brand_id' => '3']);

        $countQuery = clone $benchmarksMulti;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $elems = $benchmarksMulti->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('apple', [
            'benchmarksMulti' => $elems,
            'pages' => $pages,
            'title' => $title,
        ]);

    }

    public function actionTotal()
    {
        $title = 'Total CPU ranking from cpu-compare.com';
        $cpuTotalScore = CardTotalScore::find()->all();
        if ($cpuTotalScore === null) {
            throw new NotFoundHttpException('Bench not found');
        }
        $benchName = Yii::t('app', 'Total');
        $searchModel = new CpuTotalScoreSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('total', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'benchName' => $benchName,
        ]);

    }
    public function actionTotalGpu()
    {
        $title = 'Total GPU ranking from cpu-compare.com';
        $cpuTotalScore = GpuTotalScore::find()->all();
        if ($cpuTotalScore === null) {
            throw new NotFoundHttpException('Bench not found');
        }
        $benchName = Yii::t('app', 'Total');
        $searchModel = new GpuTotalScoreSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('total-gpu', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'benchName' => $benchName,
        ]);
    }
}
