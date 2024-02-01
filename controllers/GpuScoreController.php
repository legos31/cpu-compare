<?php
namespace app\controllers;
 
use yii\rest\ActiveController;
use app\models\Gpu;
use app\models\GpuScoreBenchmark;
use app\models\Benchmark;
use Yii;

 
class GpuScoreController extends ActiveController
{
    public $modelClass = 'app\models\GpuScoreBenchmark';
    //total Score
    
    
    //items Benchmarks
    public function actionBench($id)
    {
        $request = Yii::$app->request;
        if ($request->isGet && $id) {
            $benchmarks = GpuScoreBenchmark::find()->where('gpu_id = :gpu_id',['gpu_id' => $id])->all();
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
}
