<?php

namespace app\controllers;

use app\models\Benchmark;
use app\models\Card;
use app\models\CardBenchmark;
use app\models\CardBenchmarkItems;
use GuzzleHttp\Client;
use linslin\yii2\curl;

// подключаем Guzzle
use yii\web\Controller;

class ParserController extends Controller
{
    // public function actionList()
    // {
    //     $a = 1;
    //     $b = 20;

    //     $url = 'http://cpuboss.com/cacheable/api/stateless/search/cpus?continent=%22eu%22&override-columns=%7B%7D&range=%5B' . $a . '%2C' . $b . '%5D&sort=%5B%5B%22benchmark-aggregate-overall%22%5D%2C%5B%5D%2C%5B%5D%5D&sort-asc=false&type=%5B%5B%22desktop%22%5D%2C%5B%5D%2C%5B%5D%5D';

    //     $curl = new curl\Curl();
    //     $response = $curl->get($url);

    //     $res = json_decode($response);
    //     $table = $res->tableRows;
    //     foreach ($table as $key => $row) {

    //         $elem = \phpQuery::newDocumentHTML($row);
    //         $name = $elem->find('.product-label a')->text();
    //         $score = $elem->find("span.mobile-none:eq(1)")->text();
    //         $cores = $elem->find("span.mobile-none:eq(3)")->text();
    //         $soket = $elem->find("span.mobile-none:eq(4)")->text();
    //         $pt_dollar = $elem->find("span.mobile-none:eq(5)")->text();
    //         $pt_watt = $elem->find("span.mobile-none:eq(7)")->text();
    //         $turbo = $elem->find("span.mobile-none:eq(6)")->text();

    //         $cpu = Card::find()->where(['name' => $name])->one();
    //         if ($cpu) {
    //             $cpu->socket = $soket;
    //             $cpu->score = $score;
    //             $cpu->cores = $cores;
    //             $cpu->cores = $cores;
    //             $cpu->turbo_hertz = $turbo;
    //             $cpu->watt = $pt_watt;
    //             $cpu->pt_dollar = $pt_dollar;
    //             $cpu->last_update = time();
    //             if ($cpu->save()) {
    //                 echo $cpu->id . " - success<br>";
    //             } else {
    //                 echo $cpu->id . " - error <br>";
    //             }
    //         }
    //     }

    //     exit();
    // }

//    public function actionRating()
//    {
//
//        $list = Card::find()->all();
//
//        foreach ($list as $card) {
//            $card->image = str_replace('W:\domains\compare.loc\commands/../web', '', $card->image);
//            $card->image_mini = str_replace('W:\domains\compare.loc\commands/../web', '', $card->image_mini);
//            $card->save();
//        }
//
//        return 0;
//    }
//
//    public function actionCpu()
//    {
//
//        $client = new Client();
//
//        $cpus = Card::find()->limit(10)->all();
//        foreach ($cpus as $cpu) {
//
//            $res = $client->request('GET', $cpu->source_url);
//            $body = $res->getBody();
//            $document = \phpQuery::newDocumentHTML($body);
//            $title = $document->find("h1.product-heading")->text();
//
//            $performance = $document->find("#performance .column-contents");
//
//            foreach ($performance as $item) {
//                $pq = pq($item);
//
//                $benchmark = Benchmark::find()->where(['name' => $pq->find('.feature-title')->text()])->one();
//                if (!$benchmark) {
//                    $benchmark = new Benchmark();
//                    $benchmark->name = $pq->find('.feature-title')->text();
//                    $benchmark->description = $pq->find('.feature-subtitle')->text();
//                    $benchmark->save();
//                }
//
//                $cb = CardBenchmark::find()->where(['card_id' => $cpu->id, 'benchmark_id' => $benchmark->id])->one();
//
//                $panels = $pq->find('.panel');
//                foreach ($panels as $panel) {
//                    $p = pq($panel);
//
//                    $cbi = CardBenchmarkItems::find()->where(['name' => $p->find('.product-name-label')->text(), 'card_benchmark_id' => $cb->id])->one();
//                    if ($cbi) {
//                        $cbi->style = $p->find('.bar')->attr('style');
//                        $cbi->save();
//                    } else {
//                        $cbi = new CardBenchmarkItems();
//                        $cbi->name = $p->find('.product-name-label')->text();
//                        $cbi->value = $p->find('.score-label')->text();
//                        $cbi->card_benchmark_id = $cb->id;
//                        $cbi->style = $p->find('.bar')->attr('style');
//                        $cbi->save();
//                        // echo $cpu->source_url . ' - ' . $p->find('.product-name-label')->text() . ' - ' . $p->find('.bar')->attr('style') . "<br>";
//                        // echo $cb->id . "<br>";
//                        // echo $p;
//                    }
//                }
//            }
//        }
//
//        exit();
//        // return $this->render('cpu', ['body' => $specs]);
//    }
//
//    public function ationList()
//    {
//        $categories = ['server'];
//
//        foreach ($categories as $category) {
//            $a = 1;
//            $b = 50;
//            for ($i = 1; $i <= 250; $i++) {
//
//                $url = 'http://cpuboss.com/cacheable/api/stateless/search/cpus?continent=%22eu%22&override-columns=%7B%7D&range=%5B' . $a . '%2C' . $b . '%5D&sort=%5B%5B%22benchmark-aggregate-overall%22%5D%2C%5B%5D%2C%5B%5D%5D&sort-asc=false&type=%5B%5B%22' . $category . '%22%5D%2C%5B%5D%2C%5B%5D%5D';
//
//                $curl = new curl\Curl();
//                $response = $curl->get($url);
//
//                $res = json_decode($response);
//                $table = $res->tableRows;
//                if (!count($table)) {
//                    break;
//                }
//                foreach ($table as $key => $row) {
//
//                    $elem = \phpQuery::newDocumentHTML($row);
//
//                    echo $elem;
//                    break;
//                    // $name = $elem->find('.product-label a')->text();
//                    // if (Card::find()->where(['name' => $name])->exists()) {
//                    //     continue;
//                    // }
//
//                    // $brand = $elem->find('.product-label:first .mfg')->text();
//                    // $brand_id = null;
//                    // if ($brand == 'Intel') {
//                    //     $brand_id = 1;
//                    // } elseif ($brand == 'AMD') {
//                    //     $brand_id = 2;
//                    // } else {
//                    //     $b = new Brand();
//                    //     $b->name = $brand;
//                    //     $b->save();
//                    //     $brand_id = $b->id;
//                    // }
//
//                    // $image = $elem->find('img.product')->attr('src');
//                    // $image_mini = $elem->find('img:last')->attr('src');
//
//                    // $file = file_get_contents($image);
//                    // $path = __DIR__ . "/../web/images/uploads/card/" . $this->createAlias($name) . ".png";
//                    // file_put_contents($path, $file);
//
//                    // $file_mini = file_get_contents($image_mini);
//                    // $path2 = __DIR__ . "/../web/images/uploads/card/" . $this->createAlias($name) . "_mini.png";
//                    // file_put_contents($path2, $file_mini);
//
//                    // $cpu = new Card();
//                    // $cpu->name = $name;
//                    // $cpu->image = $path;
//                    // $cpu->category_id = 1;
//                    // $cpu->release_date = $elem->find(".product-date .date")->text();
//                    // $cpu->hertz = $elem->find(".key-specs li:first")->text();
//                    // $cpu->type = $elem->find(".key-specs li:eq(1)")->text();
//                    // $cpu->image_mini = $path2;
//                    // $cpu->source_url = 'http://cpuboss.com' . $elem->find("a.details")->attr('href');
//                    // $cpu->price = $elem->find(".wide-none .price")->text();
//                    // $cpu->score = $elem->find("span.mobile-none:eq(0)")->text();
//                    // $cpu->cores = $elem->find("span.mobile-none:eq(2)")->text();
//                    // $cpu->socket = $elem->find("span.mobile-none:eq(3)")->text();
//                    // $cpu->pt_dollar = $elem->find("span.mobile-none:eq(4)")->text();
//                    // $cpu->turbo_hertz = $elem->find("span.mobile-none:eq(5)")->text();
//                    // $cpu->watt = $elem->find("span.mobile-none:eq(6)")->text();
//                    // $cpu->l3_cache = $elem->find("span.mobile-none:last")->text();
//                    // $cpu->brand_id = $brand_id;
//                    // $cpu->category = $category;
//                    // $cpu->save();
//                }
//
//                // if ($a == 1) {
//                //     $a += 49;
//                // } else {
//                //     $a += 50;
//                // }
//                // $b += 50;
//            }
//        }
//        return 0;
//    }
}
