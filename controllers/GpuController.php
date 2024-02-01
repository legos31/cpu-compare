<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use app\models\Gpu;
use app\models\Brand;
use yii\helpers\Html;
use yii\web\Response;
use app\models\Compare;
use app\models\Pages;
use app\models\Ratings;
use yii\data\Pagination;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use app\models\GpuTotalScore;
use app\models\GpuScoreBenchmark;
use app\models\Benchmark;

class GpuController extends MainController
{

    public function actionIndex($alias)
    {
        
        $card = Gpu::find()->where(['alias' => htmlspecialchars($alias)])->one();

        if (!$card) {
            throw new NotFoundHttpException('Gpu not found');
        }
        $card->counter = $card->counter + 1;
        $card->last_view = time();
        $card->save();

        $cookies = Yii::$app->request->cookies;
        //$uniqid = $cookies->get('uniqid')->value;
        $uniqid = $cookies->getValue('uniqid');

       
        $score = GpuTotalScore::find()->where('gpu_id = :gpu_id',['gpu_id' => $card->id])->one();
        $scoreBench = $this->allBench($card->id);
        if($score) {
            $totalScore = $score->position;
        } else {
           $totalScore = null;
        }
        
        if ($uniqid) {
            $rating = Ratings::find()->where(['card_id' => $card->id, 'category' => 'gpu', 'kuki' => $uniqid])->one();
        } else {
            $rating = null;
        }
        
        $benchCount = count($card->benchmarks);
        if ($benchCount == 0) {
            $benchCount = '';
        }

        // $popular = Gpu::getDb()->cache(function () use ($card) {
        //     return Gpu::find()->limit(3)->orderBy('counter desc')->all();
        // }, 86400);
        $popular = Gpu::find()->limit(3)->orderBy('counter desc')->all();

        return $this->render('index', [
            'card' => $card,
            'popular' => $popular,
            'rating' => $rating,
            'score' => $totalScore,
            'benchCount' => $benchCount,
            'scoreBench' => $scoreBench,
        ]);
    }

    public function actionRating()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $card_id = (int) $post['card_id'];
            $value = (float) $post['value'];

            $cookies = Yii::$app->request->cookies;
            $uniqid = $cookies->get('uniqid')->value;

            // $rating = Ratings::getDb()->cache(function () use ($card_id, $uniqid){
            //     return Ratings::find()->where(['card_id' => $card_id, 'category' => 'gpu', 'kuki' => $uniqid])->one();
            // }, 86400);
            $rating = Ratings::find()->where(['card_id' => $card_id, 'category' => 'gpu', 'kuki' => $uniqid])->one();

            if ($rating) {
                $rating->value = $value;
                return $rating->save();
            } else {
                $rating = new Ratings();
                $rating->card_id = $card_id;
                $rating->value = $value;
                $rating->category = 'gpu';
                $rating->kuki = $uniqid;
                return $rating->save();
            }
        }
    }

    public function actionAutocomplete($str)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $str = Html::encode($str);

        return Gpu::find()->where(['like', 'name', $str])->select('name, image_mini, alias')->limit(10)->asArray()->all();
    }

    public function actionCompare($vs)
    {

        $arr = explode('-vs-', $vs);
        if (!isset($arr[0]) || !isset($arr[1])) throw new HttpException(404);

        $card1 = Gpu::getDb()->cache(function () use ($arr) {
            return Gpu::find()->where(['alias' => Html::encode($arr[0])])->one();
        },86400);
        //$card1 = Gpu::find()->where(['alias' => Html::encode($arr[0])])->one();
        
        $card2 = Gpu::getDb()->cache(function () use ($arr) {
            return Gpu::find()->where(['alias' => Html::encode($arr[1])])->one();
        },86400);
        //$card2 = Gpu::find()->where(['alias' => Html::encode($arr[1])])->one();
        

        if (!$card1 || !$card2) {
            throw new HttpException(404);
        }

        $benchmarks = Compare::gpuBenchmark($card1, $card2);

        $specifications = Compare::gpuSpecs($card1, $card2);

        $benchCount = count($benchmarks);
        if ($benchCount == 0) {
            $benchCount = '';
        }
		
        $compare = Compare::getDb()->cache(function () use ($card1, $card2) {
            return Compare::find()->where(['category_id' => 2, 'card_1' => $card1->id, 'card_2' => $card2->id])->one();
        },86400);
		//$compare = Compare::find()->where(['category_id' => 2, 'card_1' => $card1->id, 'card_2' => $card2->id])->one();

        $reverceCompare = Compare::getDb()->cache(function () use ($card1, $card2) {
            return Compare::find()->where(['category_id' => 2, 'card_1' => $card2->id, 'card_2' => $card1->id])->one();
        },86400);
		//$reverceCompare = Compare::find()->where(['category_id' => 2, 'card_1' => $card2->id, 'card_2' => $card1->id])->one();
        
		if (!$compare) {
            if ($reverceCompare) {
				if ($reverceCompare->url != '/gpu/compare/' . $vs) {
                    return $this->redirect(rtrim(Url::home(true), '/') . $reverceCompare->url, 301);
                }
            }
        }
        
		if ($reverceCompare && $compare) {
			if (($reverceCompare->counter ?? 0) > ($compare->counter ?? 0)) {
                if($reverceCompare->url != $compare->url) {
                    return $this->redirect(trim(Url::home(true), '/') . $reverceCompare->url, 301);
                }
				
			}
		}

        if ($compare) {
            //$compare->date = time();
            $compare->counter = $compare->counter + 1;
            //$compare->url = '/gpu/compare/' . $vs;
            $compare->save();
        } else {
			//if (stripos(Yii::$app->request->referrer, 'cpu-compare.com')) {
				$compare = new Compare();
				$compare->card_1 = $card1->id;
				$compare->card_2 = $card2->id;
				$compare->category_id = 2;
				$compare->counter = 1;
				$compare->date = time();
				$compare->url = '/gpu/compare/' . $vs;
				$compare->save();
			//}
        }

        $score1 = GpuTotalScore::getDb()->cache(function () use ($card1) {
            return GpuTotalScore::find()->where('gpu_id = :gpu_id', ['gpu_id' => $card1->id])->one();
        },86400);
        //$score1 = GpuTotalScore::find()->where('gpu_id = :gpu_id', ['gpu_id' => $card1->id])->one();

        $score2 = GpuTotalScore::getDb()->cache(function () use ($card2) {
            return GpuTotalScore::find()->where('gpu_id = :gpu_id', ['gpu_id' => $card2->id])->one();
        },86400);
        //$score2 = GpuTotalScore::find()->where('gpu_id = :gpu_id', ['gpu_id' => $card2->id])->one();

        $scoreBench1 = $this->allBench($card1->id);
        $scoreBench2 = $this->allBench($card2->id);

        return $this->render('compare', [
            'card1' => $card1,
            'card2' => $card2,
            'compare' => $compare,
            'benchmarks' => $benchmarks,
            'specifications' => $specifications,
            'benchCount' => $benchCount,
            'score1' => $score1,
            'score2' => $score2,
            'scoreBench1' => $scoreBench1,
            'scoreBench2' => $scoreBench2,
        ]);
    }

    public function actionReviews()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $query = Gpu::find();
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 4
        ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $models;
    }

    public function actionList()
    {    

        $title = 'Video cards rating';

        $query = Gpu::find();

        $get = Yii::$app->request->get();

        if (isset($get['type'])) {
            $query = $query->andWhere(['type' => htmlspecialchars($get['type'])]);
        }

        if (isset($get['brand'])) {
            $brand = Brand::findOne((int) $get['brand']);
            $title = ($brand->name ?? '') . ' rating';
            $query = $query->andWhere(['brand_id' => (int) $get['brand']]);
        }

        if (isset($get['score'])) {
            $query = $query->orderBy('score ASC');
        }

        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $cards = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('list', [
            'cards' => $cards,
            'pages' => $pages,
            'title' => $title
        ]);
    }

    public function actionMain()
    {
        $gpu = new Gpu();
        $count = Gpu::find()->count();
        $page = Pages::findOne(1);

        return $this->render('main', [
            'gpu' => $gpu,
            'page' => $page,
            'count' => $count,
        ]);
    }

    public function actionFamily()
    {
        $arrGroups = [];
        $arrSpec = [];
        
        $cpus = \app\models\GpuSpecificationItems::getDb()->cache(function () {
            return \app\models\GpuSpecificationItems::find()->asArray()->all();
        }, 86400);
        //$cpus = \app\models\GpuSpecificationItems::find()->asArray()->all();

        $i = 0;
        foreach($cpus as $cpu) {
            
            if($cpu['name'] != 'Based on'){
                continue;
            } else {
                if(!in_array($cpu['value'], $arrSpec)) {
                    $arrSpec[] = $cpu['value'];
                    $card_id = \app\models\GpuSpecification::find('gpu_id')->where(['id' => $cpu['gpu_specification_id']])->one();
                    $card = Gpu::find()->where(['id' => $card_id->gpu_id])->one();
                    if (!$card) continue;
                    $arrGroups[$i] ['based on'] =$cpu['value']; 
                    $arrGroups[$i] ['img'] = $card->image;
                    $i++;
                }
            }
            
        }
        
        return $this->render('family', [
            'groups' => $arrGroups,
        ]);
        
    }

    public function actionGroup()
    {
        $arrCpus = [];
        
        $query = \app\models\GpuSpecificationItems::find();
        $get = Yii::$app->request->get();
        
        if (isset($get['name'])) {
            $query = $query->andWhere(['value' => htmlspecialchars($get['name'])])->orderBy(['id' => SORT_DESC]);
        } else {
            $query = $query->andWhere(['name' => 'Based on']);
        }

        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $specsItems = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
           
        foreach($specsItems as $items) {
            
            $spec = \app\models\GpuSpecification::find()->where(['id' => $items->gpu_specification_id])->one();
            $cpu = Gpu::find()->where(['id' => $spec->gpu_id])->one();
            $arrCpus[] = $cpu;
            
        }
        
        return $this->render('group', [
            'cpus' => $arrCpus,
            'pages' => $pages,
        ]);
    }

    public function allBench($id)
    {
        if ($id) {
            $benchmarks = GpuScoreBenchmark::getDb()->cache(function () use ($id) {
                return GpuScoreBenchmark::find()->where('gpu_id = :gpu_id', ['gpu_id' => $id])->all();
            },86400);
            //$benchmarks = GpuScoreBenchmark::find()->where('gpu_id = :gpu_id', ['gpu_id' => $id])->all();
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
