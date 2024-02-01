<?php
namespace app\controllers;
 
use yii\rest\ActiveController;
use app\models\CardTotalScore;
use app\models\Card;
use app\models\CardScoreBenchmark;
use app\models\Benchmark;
use Yii;

 
class CpuScoreController extends ActiveController
{
    public $modelClass = 'app\models\CardTotalScore';

    public function actions()
    {
        //$actions = parent::actions();
        // disable the "delete" and "create" actions
        //unset($actions['delete'], $actions['create'], $actions['update'], $actions['options']);
        //return $actions;
                
        //return array_merge(parent::actions(), $actions);

        // $actions = parent::actions();
        // $actions['index']['prepareDataProvider'] = function ($action) {
        //     return new ActiveDataProvider([
        //         'query' => $this->modelClass::find()->where('cpu_id=:cpu_id', ['cpu_id' => '1362']),
        //     ]);
        // };

        // return $actions;
    }

    //total Score
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isGet && $id) {
            return CardTotalScore::find()->where('cpu_id = :cpu_id',['cpu_id' => $id])->one();
        } else {
            return Yii::$app->response->setStatusCode(405);
        }
    }
    
    //items Benchmarks
    public function actionBench($id)
    {
        $request = Yii::$app->request;
        if ($request->isGet && $id) {
            $benchmarks = CardScoreBenchmark::find()->where('cpu_id = :cpu_id',['cpu_id' => $id])->all();
            $arrResult = [];
            foreach ($benchmarks as $benchmark)
            {
                $benchName = Benchmark::find()->where('id = :id',['id' => $benchmark->bench_id])->one()->name;
                $position = $benchmark->position;
                $arrResult[$benchName] = $position;
            }

            return $arrResult;
        } else {
            return Yii::$app->response->setStatusCode(405);

        }
        
    }
    public function allBench($id)
    {
        if ($id) {
            $benchmarks = CardScoreBenchmark::find()->where('cpu_id = :cpu_id', ['cpu_id' => $id])->all();
            $arrResult = [];
            foreach ($benchmarks as $benchmark) {
                $benchName = Benchmark::find()->where('id = :id', ['id' => $benchmark->bench_id])->one()->name;
                $position = $benchmark->position;
                $arrResult[$benchName] = $position;
            }

            return $arrResult;
        } else {
            return false;
        }
    }
}
