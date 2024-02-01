<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\Gpu;
use app\models\CardScoreBenchmark;
use app\models\Benchmark;
use app\models\CardBenchmark;
use app\models\Card;
use app\models\GpuBenchmark;
use app\models\GpuScoreBenchmark;
use yii\helpers\ArrayHelper;
use app\models\CardTotalScore;
use app\models\GpuTotalScore;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    // public function actionIndex($message = 'hello world')
    // {
    //     echo $message . "\n";

    //     return ExitCode::OK;
    // }

    // public function actionImage() {
    //     $gpus = Gpu::find()->all();
    //     $name = '';
    //     foreach ($gpus as $gpu) {
    //         $arr = explode(' ',trim($gpu->name));
    //         $name =  trim ($arr[0]);
    //         if (strtolower($name) == 'nvidia')
    //         {
    //             $gpu->image_logo = '/images/gpu/nvidia_logo.png';
    //             $gpu->save(false);
    //         }
    //     }
    //     echo 'done';
    // }
    
    //создаем таблицу card_score_benchmark, результаты бенчмарков по каждому процессору
    public function actionCreateBenchmarksCpu()
    {

        $allBenchmarks = Benchmark::find()->asArray()->all();
        //var_dump($allBenchmarks);
        foreach ( $allBenchmarks as $item) {
            //получаем конкретный benchmark и связанный с ним процессор
            $resultArray = [];
            $benchmarks = CardBenchmark::find()->where(['benchmark_id' => $item['id']])->all();
            foreach ($benchmarks as $benchmark) {
                $results = $benchmark->items;

                foreach ($results as $elem){
                    $resultArray [$elem->name] = (int) $elem->value;
                }

            }
            arsort($resultArray);
            $pos = 1;
            foreach ($resultArray as $key => $value) {
                $card = Card::find()->where(['name' => $key])->one();
                if ($card) {
                    $score = new CardScoreBenchmark();
                    $score->cpu_id = $card->id;
                    $score->bench_id = $item['id'];
                    $score->score = $value;
                    $score->position = $pos;
                    $score->save(false);
                    $pos++;
                }
            }
        }

        echo 'done';

    }
    
    //создаем таблицу gpu_score_benchmark, результаты бенчмарков по каждой видеокарте
    public function actionCreateBenchmarksGpu() {

        $cards = Gpu::find()->all();
        $resultArray = [];
       
        foreach ($cards as $card) {
           
            foreach ($card->benchmarks as $benchmarks) {
                //получаем все бенчмарки gpu id
                //here GpuBenchmark::find()->where(['gpu_id' => $this->id])->all();
                
                foreach ($benchmarks->items as $item) {
                    //получаем все значения сохраненные для этого бенчмарка с этой gpu
                    //return $this->hasMany(GpuBenchmarkItems::className(), ['gpu_benchmark_id' => 'id'])->limit(3);
                    //здесь находим gpu саму себя и получаем ее значение
                    if($card->name == $item->name) {
                        $resultArray [$benchmarks->benchmark_id][$item->name] = preg_replace("/[^0-9.]/", '', $item->value);
                    }
                }
                
            } 
           
        } 

        foreach ($resultArray as $bench => $elem) {
            arsort($elem);
            $pos = 1;
            foreach ($elem as $key => $value) {
                $card = Gpu::find()->where(['name' => $key])->one();
                if ($card) {
                    $score = new GpuScoreBenchmark();
                    $score->gpu_id = $card->id;
                    $score->bench_id = $bench;
                    $score->score = $value;
                    $score->position = $pos;
                    $score->save(false);
                    $pos++;
                }
            }
        }
       
    }
    
    //создаем таблицу card_total_score для хранения общего рейтинга процессоров
    public function actionCardTotalScore() {
        $cards = Card::find()->all();
        $resArray = [];
        foreach ($cards as $card) {
            $sum = CardScoreBenchmark::find()->where(['cpu_id' => $card->id])->sum('position');
            $count = count(CardScoreBenchmark::find()->where(['cpu_id' => $card->id])->all());
            if (($count > 2) && ($sum > 0)) {
                $totalScore = intval($sum/$count);
                $resArray[] = ['id' => $card->id, 'brand' => $card->brand_id, 'total_score' => $totalScore, 'mobile' => ($card->category == 'Mobile') ? 1 : 0];
                
            }
            
        }
        ArrayHelper::multisort($resArray, 'total_score', SORT_ASC);
        
        if (count($resArray) > 0) 
        {
            $pos = 1;
            foreach ($resArray as $value)
            {
                $score = new CardTotalScore();
                $score->cpu_id = $value['id'];
                $score->brand_id = $value['brand'];
                $score->total_score = $value['total_score'];
                $score->mobile = $value['mobile'];
                $score->position = $pos;
                $score->save(false);
                $pos++;
            }
        }
    }

    //создаем таблицу gpu_total_score для хранения общего рейтинга процессоров
    public function actionGpuTotalScore() {
        $cards = Gpu::find()->all();
        $resArray = [];
        foreach ($cards as $card) {
            $sum = GpuScoreBenchmark::find()->where(['gpu_id' => $card->id])->sum('position');
            $count = count(GpuScoreBenchmark::find()->where(['gpu_id' => $card->id])->all());
            if (($count > 2) && ($sum > 0)) {
                $totalScore = intval($sum/$count);
                $resArray[] = ['id' => $card->id, 'brand' => $card->brand_id, 'total_score' => $totalScore];
                
            }
            
        }
        
        ArrayHelper::multisort($resArray, 'total_score', SORT_ASC);
        
        if (count($resArray) > 0) 
        {
            $pos = 1;
            foreach ($resArray as $value)
            {
                $score = new GpuTotalScore();
                $score->gpu_id = $value['id'];
                $score->brand_id = $value['brand'];
                $score->total_score = $value['total_score'];
                $score->position = $pos;
                $score->save(false);
                $pos++;
            }
        }
    }
}
