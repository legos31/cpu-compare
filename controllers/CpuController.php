<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use app\models\Card;
use app\models\Benchmark;
use app\models\Pages;
use app\models\Brand; 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use app\models\Compare;
use app\models\Ratings;
use app\models\Comments;
use yii\data\Pagination;
use yii\web\HttpException;
use app\models\CommentForm;
use app\models\CommentUsers;
use yii\web\NotFoundHttpException;
use app\models\CardTotalScore;
use app\models\CardScoreBenchmark;

class CpuController extends MainController
{
    // public function behaviors()
    // {
    //     return [
    //         'pageCache' => [
    //             'class' => 'yii\filters\PageCache',
    //             'only' => ['index', 'family', 'compare'],
    //             'duration' => 3600 * 24,
    //             'variations' => [
    //                 \Yii::$app->request->get('alias'),
    //                 \Yii::$app->request->get('vs'),
    //                 isset(Yii::$app->language) ? Yii::$app->language : null,
    //             ],
    //             'dependency' => [
    //                 'class' => 'yii\caching\DbDependency',
    //                 'sql' => 'SELECT COUNT(*) FROM ratings',
    //             ],
    //         ]

    //     ];
    // }

    // public function behaviors()
    // {
    //     return [

    //         'httpCache' => [
    //             'class' => 'yii\filters\HttpCache',
    //             'only' => ['index', 'main', 'family', 'compare'],
    //             'lastModified' => function ($action, $params) {
    //                 $ifModified = strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'] ?? '');
    //                 if ($action->id === 'index') {
    //                     if (Yii::$app->language === 'en') {
    //                         $cpu = substr(Yii::$app->request->url, 5);
    //                     } elseif (Yii::$app->language === 'zh-CN') {
    //                         $cpu = substr(Yii::$app->request->url, 11);
    //                     } else {
    //                         $cpu = substr(Yii::$app->request->url, 8);
    //                     }
                        
    //                     $model = \app\models\Card::find()->where(['alias' => $cpu])->limit(1)->one();

    //                     if ($model) {

    //                         if ($model->date) {
    //                             $lastModified = $model->date;
    //                         } else {
    //                             $lastModified = strtotime('2022-05-05 10:01:01');
    //                         }
    //                     } else {
    //                         $lastModified = strtotime('2021-05-05 10:01:01');
    //                     }

    //                     if ($ifModified  && $ifModified >= $lastModified) {
    //                         Yii::$app->response->statusCode = 304;
    //                     }
    //                     return $lastModified;
    //                 } elseif (($action->id === 'main') || ($action->id === 'family')) {
    //                     $lastModified = time() - 259200;

    //                     if ($ifModified  && $ifModified >= $lastModified) {
    //                         Yii::$app->response->statusCode = 304;
    //                     }
    //                     return $lastModified;
    //                 } elseif ($action->id === 'compare') {
    //                     if (Yii::$app->language === 'en') {
    //                         $compare = Yii::$app->request->url;
    //                     } elseif (Yii::$app->language === 'zh-CN') {
    //                         $compare = substr(Yii::$app->request->url, 6);
    //                     } else {
    //                         $compare = substr(Yii::$app->request->url,3);
    //                     }
                        
    //                     $model = \app\models\Compare::find()->where(['url' => $compare])->limit(1)->one();
    //                     if ($model) {

    //                         if ($model->date) {
    //                             $lastModified = $model->date;
    //                         } else {
    //                             $lastModified = strtotime('2022-05-05 10:01:01');
    //                         }
    //                     } else {
    //                         $lastModified = strtotime('2021-05-05 10:01:01');
    //                     }

    //                     if ($ifModified  && $ifModified >= $lastModified) {
    //                         Yii::$app->response->statusCode = 304;
    //                     }
    //                     return $lastModified;
    //                 }
					
    //             },

    //             'sessionCacheLimiter' => 'public',
    //             'cacheControlHeader' => 'public, max-age=3600',
    //         ],
    //     ];
    // }
   
    public function actionIndex($alias)
    {
        // $card = Card::getDb()->cache(function () use ($alias) {
        //     return Card::find()->where(['alias' => htmlspecialchars($alias)])->one();
        // },86400);
        $card = Card::find()->where(['alias' => htmlspecialchars($alias)])->one();
        
        if (!$card) {
            throw new NotFoundHttpException('Cpu not found');
        }

        $card->counter = $card->counter + 1;
	    $card->last_view = time();
        $card->save(false);

        $cookies = Yii::$app->request->cookies;
        
        $uniqid = $cookies->getValue('uniqid');

        // $score = CardTotalScore::getDb()->cache(function () use ($card) {
        //     return CardTotalScore::find()->where('cpu_id = :cpu_id',['cpu_id' => $card->id])->one();
        // },86400);
        $score = CardTotalScore::find()->where('cpu_id = :cpu_id',['cpu_id' => $card->id])->one();

        $scoreBench = $this->allBench($card->id);

        if($score) {
            $totalScore = $score->position;
        } else {
            $totalScore = null;
        }
        if ($uniqid) {
            $rating = Ratings::find()->where(['card_id' => $card->id, 'category' => 'cpu', 'kuki' => $uniqid])->one();
        } else {
            $rating = null;
        }
        $benchmarksCount = count($card->benchmarks);
        if ($benchmarksCount == 0) {
            $benchmarksCount = '';
        }
        
        return $this->render('index', [
            'card' => $card,
            'rating' => $rating,
            'score' => $totalScore,
            'benchmarksCount' => $benchmarksCount,
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
            $rating = Ratings::find()->where(['card_id' => $card_id, 'category' => 'cpu', 'kuki' => $uniqid])->one();
            if ($rating) {
                $rating->value = $value;
                return $rating->save();
            } else {
                $rating = new Ratings();
                $rating->card_id = $card_id;
                $rating->value = $value;
                $rating->category = 'cpu';
                $rating->kuki = $uniqid;
                return $rating->save();
            }
        }
    }

    public function actionAutocomplete($str)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $str = Html::encode($str);

        return Card::find()->where(['like', 'name', $str])->select('name, image_mini, alias')->limit(10)->asArray()->all();
    }

    public function actionCompare($vs)
    {
        

        $arr = explode('-vs-', $vs);
        if (!isset($arr[0]) || !isset($arr[1])) throw new HttpException(404);

        $card1 = Card::getDb()->cache(function () use ($arr) {
            return Card::find()->where(['alias' => Html::encode($arr[0])])->one();
        },86400);
        //$card1 = Card::find()->where(['alias' => Html::encode($arr[0])])->one();

        $card2 = Card::getDb()->cache(function () use ($arr){
            return Card::find()->where(['alias' => Html::encode($arr[1])])->one();
        },86400);
        //$card2 = Card::find()->where(['alias' => Html::encode($arr[1])])->one();    		

        if (!$card1 || !$card2) {
            throw new HttpException(404);
        }
        
        $compare = Compare::getDb()->cache(function () use ($card1, $card2) {
            return Compare::find()->where(['category_id' => 1, 'card_1' => $card1->id, 'card_2' => $card2->id])->one();
        },86400);
        //$compare = Compare::find()->where(['category_id' => 1, 'card_1' => $card1->id, 'card_2' => $card2->id])->one();

        $reverceCompare = Compare::getDb()->cache(function () use ($card1, $card2) {
            return Compare::find()->where(['category_id' => 1, 'card_1' => $card2->id, 'card_2' => $card1->id])->one();
        },86400);
		//$reverceCompare = Compare::find()->where(['category_id' => 1, 'card_1' => $card2->id, 'card_2' => $card1->id])->one();

        if (!$compare) {
            if ($reverceCompare) {
				if ($reverceCompare->url != '/cpu/compare/' . $vs) {
                    return $this->redirect(rtrim(Url::home(true), '/') . $reverceCompare->url, 301);
                }
            }
        }
        
		if ($reverceCompare && $compare) {
			if (($reverceCompare->counter ?? 0) > ($compare->counter ?? 0)) {
                if ($reverceCompare->url != $compare->url) {
                    return $this->redirect(rtrim(Url::home(true), '/') . $reverceCompare->url, 301);
                }
				
			}
		}

        $benchmarks = Compare::cardBenchmark($card1, $card2);

        $benchCount = count($benchmarks);
        if ($benchCount == 0) {
            $benchCount = '';
        }

        $specifications = Compare::cardSpecs($card1, $card2);

        if ($compare) {
            //$compare->date = time();
            $compare->counter = $compare->counter + 1;
            //$compare->url = '/cpu/compare/' . $vs;
            $compare->save();
        } else {
			//if (stripos(Yii::$app->request->referrer, 'cpu-compare.com')) {
				$compare = new Compare();
				$compare->card_1 = $card1->id;
				$compare->card_2 = $card2->id;
				$compare->category_id = 1;
				$compare->counter = 1;
				$compare->date = time();
				$compare->url = '/cpu/compare/' . $vs;
				$compare->save();
			//}
        }

        $score1 = CardTotalScore::getDb()->cache(function () use ($card1) {
            return CardTotalScore::find()->where('cpu_id = :cpu_id', ['cpu_id' => $card1->id])->one();
        },86400);
        //$score1 = CardTotalScore::find()->where('cpu_id = :cpu_id', ['cpu_id' => $card1->id])->one();

        $score2 = CardTotalScore::getDb()->cache(function () use ($card2) {
            return CardTotalScore::find()->where('cpu_id = :cpu_id', ['cpu_id' => $card2->id])->one();
        },86400);
        //$score2 = CardTotalScore::find()->where('cpu_id = :cpu_id', ['cpu_id' => $card2->id])->one();

        $scoreBench1 = $this->allBench($card1->id);
        $scoreBench2 = $this->allBench($card2->id);

        return $this->render('compare', [
            'card1' => $card1,
            'card2' => $card2,
            'compare' => $compare,
            'benchmarks' => $benchmarks,
            'specifications' => $specifications,
            'benchCount' => $benchCount, 
            'c1' => $compare->url,
            'c2' => $card1->alias .'-vs-'.$card2->alias,
            'score1' => $score1,
            'score2' => $score2,
            'scoreBench1' => $scoreBench1,
            'scoreBench2' => $scoreBench2,
        ]);
        
        
    }

    public function actionReviews()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $query = Card::find();
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

        $title = Yii::t('app', 'Processors rating');

        //$query = Card::find();
        $query = Card::getDb()->cache(function () {
            return Card::find();;
        }, 86400);

        $get = Yii::$app->request->get();

        if (isset($get['type'])) {
            $query = $query->andWhere(['category' => htmlspecialchars($get['type'])]);
        }

        if (isset($get['brand'])) {
            $brand = Brand::findOne((int) $get['brand']);
            $title = ($brand->name ?? '') . ' rating';
            $query = $query->andWhere(['brand_id' => (int) $get['brand']]);
        }

        if (isset($get['score'])) {
            $query = $query->orderBy('score ' . htmlspecialchars($get['score']));
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
        $count = Card::find()->count();
        $cpu = new Card();
        $page = Pages::findOne(1);

        return $this->render('main', [
            'cpu' => $cpu,
            'page' => $page,
            'count' => $count,
        ]);
    }
    
    public function actionFamily()
    {
        $arrGroups = [];
        $arrSpec = [];
        
        //$cpus = \app\models\CardSpecificationItems::find()->asArray()->all();
        $cpus = \app\models\CardSpecificationItems::getDb()->cache(function () {
            return \app\models\CardSpecificationItems::find()->asArray()->all();
        }, 86400);

        $i = 0;
        foreach($cpus as $cpu) {
            
            if($cpu['name'] != 'Family'){
                continue;
            } else {
                if(!in_array($cpu['value'], $arrSpec)) {
                    $arrSpec[] = $cpu['value'];
                    $card_id = \app\models\CardSpecification::find('card_id')->where(['id' => $cpu['card_specification_id']])->one();
                    $card = Card::find()->where(['id' => $card_id->card_id])->one();
                    $arrGroups[$i] ['family'] =$cpu['value']; 
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
        
        $query = \app\models\CardSpecificationItems::find();
        $get = Yii::$app->request->get();
        
        if (isset($get['name'])) {
            $query = $query->andWhere(['value' => htmlspecialchars($get['name'])])->orderBy(['id' => SORT_DESC]);
        } else {
            $query = $query->andWhere(['name' => 'family']);
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
            
            $spec = \app\models\CardSpecification::find()->where(['id' => $items->card_specification_id])->one();
            $cpu = Card::find()->where(['id' => $spec->card_id])->asArray()->one();
            if (!in_array($cpu, $arrCpus)) {
                $arrCpus[] = $cpu;
            }
            
        }

        // ArrayHelper::multisort($arrCpus, function ($item) {            
        //     $year = explode('/', $item['release_date'])[1];
        //     $year = parseNumber($year);
        //     return $year;
        // }, [SORT_ASC]);

        //ArrayHelper::multisort($arrCpus, 'cores', [SORT_ASC]);
        //usort($arrCpus, [CpuController::class, "sortArrayCpu"]);
        
        return $this->render('group', [
            'cpus' => $arrCpus,
            'pages' => $pages,
        ]);
        
    }

    public function allBench($id)
    {
        if ($id) {
            $benchmarks = CardScoreBenchmark::getDb()->cache(function () use ($id) {
                return CardScoreBenchmark::find()->where('cpu_id = :cpu_id', ['cpu_id' => $id])->all();
            },86400);
            //$benchmarks = CardScoreBenchmark::find()->where('cpu_id = :cpu_id', ['cpu_id' => $id])->all();
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
	
	public static function sortArrayCpu($param1, $param2)
    {
        $qvartal_p1 = parseNumber(explode('/', $param1->release_date)[0]);
        $qvartal_p1 = preg_match('/[0-9]/', $qvartal_p1);
        $year_p1 = parseNumber(explode('/', $param1->release_date)[1]);
        $year_p1 = preg_match('/[0-9]/', $year_p1);

        $qvartal_p2 = parseNumber(explode('/', $param2->release_date)[0]);
        $qvartal_p2 = preg_match('/[0-9]/', $qvartal_p2);
        $year_p2 = parseNumber(explode('/', $param2->release_date)[1]);
        $year_p2 = preg_match('/[0-9]/', $year_p2);

        if ($year_p1 == $year_p2) {
            if ($qvartal_p1 == $qvartal_p2) {
                return 0;
            } elseif ($qvartal_p1 > $qvartal_p2) {
                return 1;
            } elseif($qvartal_p1 < $qvartal_p2) {
                return -1;
            }            
        } elseif ($year_p1 > $year_p2) {
            return 1;
        } elseif ($year_p1 < $year_p2) {
            return -1;
        } else {
            return 0;
        }

    }
}
