<?php

namespace app\commands;

use app\models\Benchmark;
use app\models\Brand;
use app\models\Card;
use app\models\CardBenchmark;
use app\models\CardBenchmarkItems;
use app\models\CardSpecification;
use app\models\CardSpecificationItems;
use app\models\Gpu;
use app\models\GpuBenchmark;
use app\models\GpuBenchmarkItems;
use app\models\GpuSpecification;
use app\models\GpuSpecificationItems;
use app\models\Specification;
use GuzzleHttp\Client;
use linslin\yii2\curl;
use yii\console\Controller;

class ParserController extends Controller
{

    public function createAlias($s)
    {
        $s = (string) $s; // преобразуем в строковое значение
        $s = strip_tags($s); // убираем HTML-теги
        $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
        $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
        $s = trim($s); // убираем пробелы в начале и конце строки
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
        $s = strtr($s, array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => ''));
        $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
        $s = str_replace(" ", "_", $s); // заменяем пробелы знаком минус
        return $s; // возвращаем результат
    }

    public function actionCpusupdate()
    {
        $categories = ['desktop'];

        foreach ($categories as $category) {
            $a = 1;
            $b = 50;
            for ($i = 1; $i <= 250; $i++) {

                $url = 'http://cpuboss.com/cacheable/api/stateless/search/cpus?continent=%22eu%22&override-columns=%7B%7D&range=%5B' . $a . '%2C' . $b . '%5D&sort=%5B%5B%22benchmark-aggregate-overall%22%5D%2C%5B%5D%2C%5B%5D%5D&sort-asc=false&type=%5B%5B%22' . $category . '%22%5D%2C%5B%5D%2C%5B%5D%5D';

                $curl = new curl\Curl();
                $response = $curl->get($url);

                $res = json_decode($response);
                $table = $res->tableRows;
                if (!count($table)) {
                    break;
                }
                foreach ($table as $key => $row) {

                    $elem = \phpQuery::newDocumentHTML($row);
                    $name = $elem->find('.product-label a')->text();
                    $score = $elem->find("span.mobile-none:eq(1)")->text();
                    $cores = $elem->find("span.mobile-none:eq(3)")->text();
                    $soket = $elem->find("span.mobile-none:eq(4)")->text();
                    $pt_dollar = $elem->find("span.mobile-none:eq(5)")->text();
                    $pt_watt = $elem->find("span.mobile-none:eq(7)")->text();
                    $turbo = $elem->find("span.mobile-none:eq(6)")->text();

                    $cpu = Card::find()->where(['name' => $name])->one();
                    if ($cpu) {
                        $cpu->socket = $soket;
                        $cpu->score = $score;
                        $cpu->cores = $cores;
                        $cpu->turbo_hertz = $turbo;
                        $cpu->watt = $pt_watt;
                        $cpu->pt_dollar = $pt_dollar;
                        $cpu->last_update = time();
                        if ($cpu->save()) {
                            echo $cpu->id . " - success<br>";
                        } else {
                            echo $cpu->id . " - error <br>";
                        }
                    }

                }

                if ($a == 1) {
                    $a += 49;
                } else {
                    $a += 50;
                }
                $b += 50;

            }
        }
    }

    public function actionIndex()
    {
        $begin = time();

        $categories = ['desktop', 'laptop', 'server', 'embedded'];

        foreach ($categories as $category) {
            $a = 1;
            $b = 50;
            for ($i = 1; $i <= 250; $i++) {

                $url = 'http://cpuboss.com/cacheable/api/stateless/search/cpus?continent=%22eu%22&override-columns=%7B%7D&range=%5B' . $a . '%2C' . $b . '%5D&sort=%5B%5B%22benchmark-aggregate-overall%22%5D%2C%5B%5D%2C%5B%5D%5D&sort-asc=false&type=%5B%5B%22' . $category . '%22%5D%2C%5B%5D%2C%5B%5D%5D';

                $curl = new curl\Curl();
                $response = $curl->get($url);

                $res = json_decode($response);
                $table = $res->tableRows;
                if (!count($table)) {
                    break;
                }
                foreach ($table as $key => $row) {

                    $elem = \phpQuery::newDocumentHTML($row);
                    $name = $elem->find('.product-label a')->text();
                    if (Card::find()->where(['name' => $name])->exists()) {
                        continue;
                    }

                    $brand = $elem->find('.product-label:first .mfg')->text();
                    $brand_id = null;
                    if ($brand == 'Intel') {
                        $brand_id = 1;
                    } elseif ($brand == 'AMD') {
                        $brand_id = 2;
                    } else {
                        $b = new Brand();
                        $b->name = $brand;
                        $b->save();
                        $brand_id = $b->id;
                    }

                    $image = $elem->find('img.product')->attr('src');
                    $image_mini = $elem->find('img:last')->attr('src');

                    $file = file_get_contents($image);
                    $path = __DIR__ . "/../web/images/uploads/card/" . $this->createAlias($name) . ".png";
                    file_put_contents($path, $file);

                    $file_mini = file_get_contents($image_mini);
                    $path2 = __DIR__ . "/../web/images/uploads/card/" . $this->createAlias($name) . "_mini.png";
                    file_put_contents($path2, $file_mini);

                    $cpu = new Card();
                    $cpu->name = $name;
                    $cpu->image = $path;
                    $cpu->category_id = 1;
                    $cpu->release_date = $elem->find(".product-date .date")->text();
                    $cpu->hertz = $elem->find(".key-specs li:first")->text();
                    $cpu->type = $elem->find(".key-specs li:eq(1)")->text();
                    $cpu->image_mini = $path2;
                    $cpu->source_url = 'http://cpuboss.com' . $elem->find("a.details")->attr('href');
                    $cpu->price = $elem->find(".wide-none .price")->text();
                    $cpu->score = $elem->find("span.mobile-none:eq(0)")->text();
                    $cpu->cores = $elem->find("span.mobile-none:eq(2)")->text();
                    $cpu->socket = $elem->find("span.mobile-none:eq(3)")->text();
                    $cpu->pt_dollar = $elem->find("span.mobile-none:eq(4)")->text();
                    $cpu->turbo_hertz = $elem->find("span.mobile-none:eq(5)")->text();
                    $cpu->watt = $elem->find("span.mobile-none:eq(6)")->text();
                    $cpu->l3_cache = $elem->find("span.mobile-none:last")->text();
                    $cpu->brand_id = $brand_id;
                    $cpu->category = $category;
                    $cpu->save();
                }

                if ($a == 1) {
                    $a += 49;
                } else {
                    $a += 50;
                }
                $b += 50;

            }
        }

        return time() - $begin;
    }

    public function actionRating()
    {
        $client = new Client();

        $list = Card::find()->all();

        foreach ($list as $card) {
            $res = $client->request('GET', $card->source_url);
            $body = $res->getBody();
            $document = \phpQuery::newDocumentHTML($body);
            $rating = $document->find(".score-text")->text();

            $card->rating = $rating ?? 0;
            $card->save();
        }

        return 0;
    }

    public function actionCpubench()
    {
        $client = new Client();

        $cpus = Gpu::find()->all();
        foreach ($cpus as $cpu) {

            $res = $client->request('GET', $cpu->source_url);
            $body = $res->getBody();
            $document = \phpQuery::newDocumentHTML($body);
            $title = $document->find("h1.product-heading")->text();

            $performance = $document->find("#performance .column-contents");

            foreach ($performance as $item) {
                $pq = pq($item);

                $benchmark = Benchmark::find()->where(['name' => $pq->find('.feature-title')->text()])->one();
                if (!$benchmark) {
                    $benchmark = new Benchmark();
                    $benchmark->name = $pq->find('.feature-title')->text();
                    $benchmark->description = $pq->find('.feature-subtitle')->text();
                    $benchmark->save();
                }

                $cb = GpuBenchmark::find()->where(['gpu_id' => $cpu->id, 'benchmark_id' => $benchmark->id])->one();

                $panels = $pq->find('.panel');
                foreach ($panels as $panel) {
                    $p = pq($panel);

                    $cbi = GpuBenchmarkItems::find()->where(['name' => $p->find('.product-name-label')->text(), 'gpu_benchmark_id' => $cb->id])->one();
                    if ($cbi) {
                        $cbi->style = $p->find('.bar')->attr('style');
                        $cbi->save();
                    } else {
                        $cbi = new GpuBenchmarkItems();
                        $cbi->name = $p->find('.product-name-label')->text();
                        $cbi->value = $p->find('.score-label')->text();
                        $cbi->gpu_benchmark_id = $cb->id;
                        $cbi->style = $p->find('.bar')->attr('style');
                        $cbi->save();
                    }

                }

            }
            echo $cpu->id . "\n";

        }

        return 0;
    }

    public function actionCpu()
    {

        $client = new Client();

        $list = Card::find()->where(['status' => 0])->all();

        foreach ($list as $card) {
            $res = $client->request('GET', $card->source_url);
            $body = $res->getBody();
            $document = \phpQuery::newDocumentHTML($body);
            $description = $document->find(".snippet-text:first")->text();

            $card->description = $description;
            $card->status = 1;
            $card->save();

            $specs = $document->find(".specs-group");
            foreach ($specs as $elem) {
                $pq = pq($elem);
                $specification = $pq->find('h3.group')->text();

                $sp = Specification::find()->where(['name' => $specification])->one();
                if (!$sp) {
                    $sp = new Specification();
                    $sp->name = $specification;
                    $sp->save();
                }

                $cp = new CardSpecification();
                $cp->card_id = $card->id;
                $cp->specification_id = $sp->id;
                $cp->save();

                $trs = $pq->find('table tr');
                foreach ($trs as $item) {
                    $tr = pq($item);
                    $csi = new CardSpecificationItems();
                    $csi->name = $tr->find('th')->text();
                    $csi->value = $tr->find('td')->text();
                    $csi->card_specification_id = $cp->id;
                    $csi->save();
                }
            }

            $performance = $document->find("#performance .column-contents");
            foreach ($performance as $item) {
                $pq = pq($item);

                $benchmark = Benchmark::find()->where(['name' => $pq->find('.feature-title')->text()])->one();
                if (!$benchmark) {
                    $benchmark = new Benchmark();
                    $benchmark->name = $pq->find('.feature-title')->text();
                    $benchmark->description = $pq->find('.feature-subtitle')->text();
                    $benchmark->save();
                }

                $cb = new CardBenchmark();
                $cb->card_id = $card->id;
                $cb->benchmark_id = $benchmark->id;
                $cb->save();

                $panels = $pq->find('.panel');
                foreach ($panels as $panel) {
                    $p = pq($panel);
                    $cbi = new CardBenchmarkItems();
                    $cbi->name = $p->find('.product-name-label')->text();
                    $cbi->value = $p->find('.score-label')->text();
                    $cbi->card_benchmark_id = $cb->id;
                    $cbi->save();
                }

            }
        }

        return 0;
    }

    public function check_url($url)
    {
        $headers = @get_headers($url);
        return $headers && strpos($headers[0], '200');

    }

    public function actionGpus()
    {

        $a = 400;
        $b = 600;
//        for ($i = 1; $i <= 500; $i++) {

        $url = 'http://gpuboss.com/cacheable/api/stateless/search/gpus?continent="eu"&market=[["-9223372036844526703"],[],[]]&override-columns={}&range=[' . $a . ',' . $b . ']&sort=[["passmark"],[],[]]&sort-asc=false';

        $curl = new curl\Curl();
        $response = $curl->get($url);
        $res = json_decode($response);
        $table = $res->tableRows;
//            if (!count($table)) {
        //                break;
        //            }
        //            echo $i .'-'.$b. "\n";
        foreach ($table as $key => $row) {

            $elem = \phpQuery::newDocumentHTML($row);

            $name = $elem->find('.product-label a')->text();
            if (Gpu::find()->where(['name' => $name])->exists()) {
                echo $key . '-' . $name . " -exist \n";
                continue;
            }
            echo $key . '-' . $name . " -new \n";

            $brand = $elem->find('.product-label:first .mfg')->text();
            $brand_id = null;
            $brand_model = Brand::find()->where(['name' => $brand])->one();
            if ($brand_model) {
                $brand_id = $brand_model->id;
            } else {
                $b = new Brand();
                $b->name = $brand;
                $b->save();
                $brand_id = $b->id;
            }

            $image = $elem->find('img.product')->attr('src');
            $image_mini = $elem->find('img:eq(1)')->attr('src');

            $path = __DIR__ . "/../web/images/uploads/gpu/" . $this->createAlias($name) . ".png";
            if ($this->check_url($image)) {
                $file = file_get_contents($image);
                file_put_contents($path, $file);
            }

            $path2 = __DIR__ . "/../web/images/uploads/gpu/" . $this->createAlias($name) . "_mini.png";
            if ($this->check_url($image_mini)) {
                $file_mini = file_get_contents($image_mini);
                file_put_contents($path2, $file_mini);
            }
            $gpu = new Gpu();
            $gpu->name = $name;
            $gpu->image = $path;
            $gpu->category_id = 2;
            $gpu->release_date = $elem->find(".product-date .date")->text();
            $gpu->hertz = $elem->find(".key-specs li:first")->text();
            $gpu->type = $elem->find("span.mobile-none:eq(2)")->text();
            $gpu->image_mini = $path2;
            $gpu->source_url = 'http://cpuboss.com' . $elem->find("a.details")->attr('href');
            $gpu->price = $elem->find(".wide-none .price")->text();
            $gpu->score = $elem->find("span.mobile-none:eq(1)")->text();
            $gpu->brand_id = $brand_id;
            $gpu->memory_size = $elem->find("span.mobile-none:eq(4)")->text();
            $gpu->memory_type = $elem->find("span.mobile-none:eq(5)")->text();
            $gpu->save();
//                echo $gpu->id . '. ' . $name . "\n";
        }

//            if ($a == 1) {
        //                $a += 49;
        //            } else {
        //                $a += 50;
        //            }
        //            $b += 50;

//        }
    }

    public function actionGpu()
    {

        $client = new Client();

        $list = Gpu::find()->all();

        foreach ($list as $card) {
            $card->source_url = str_replace('cpuboss.com', 'gpuboss.com', $card->source_url);
            $card->image = str_replace('W:\domains\compare.loc\commands/../web', '', $card->image);
            $card->image_mini = str_replace('W:\domains\compare.loc\commands/../web', '', $card->image_mini);

            $res = $client->request('GET', $card->source_url);
            $body = $res->getBody();
            $document = \phpQuery::newDocumentHTML($body);
            $description = $document->find(".snippet-text:first")->text();
            $rating = $document->find(".score-text")->text();

            $card->rating = $rating ?? 0;
            $card->description = $description;
            $card->status = 1;
            $card->save();
            echo $card->id . ' - ' . $card->name . "\n";

            $specs = $document->find(".specs-group");
            foreach ($specs as $elem) {
                $pq = pq($elem);
                $specification = $pq->find('h3.group')->text();

                $sp = Specification::find()->where(['name' => $specification])->one();
                if (!$sp) {
                    $sp = new Specification();
                    $sp->name = $specification;
                    $sp->save();
                }

                $cp = new GpuSpecification();
                $cp->gpu_id = $card->id;
                $cp->specification_id = $sp->id;
                $cp->save();

                $trs = $pq->find('table tr');
                foreach ($trs as $item) {
                    $tr = pq($item);
                    $csi = new GpuSpecificationItems();
                    $csi->name = $tr->find('th')->text();
                    $csi->value = $tr->find('td')->text();
                    $csi->gpu_specification_id = $cp->id;
                    $csi->save();
                }
            }

            $performance = $document->find("#performance .column-contents");
            foreach ($performance as $item) {
                $pq = pq($item);

                $benchmark = Benchmark::find()->where(['name' => $pq->find('.feature-title')->text()])->one();
                if (!$benchmark) {
                    $benchmark = new Benchmark();
                    $benchmark->name = $pq->find('.feature-title')->text();
                    $benchmark->description = $pq->find('.feature-subtitle')->text();
                    $benchmark->save();
                }

                $cb = new GpuBenchmark();
                $cb->gpu_id = $card->id;
                $cb->benchmark_id = $benchmark->id;
                $cb->save();

                $panels = $pq->find('.panel');
                foreach ($panels as $panel) {
                    $p = pq($panel);
                    $cbi = new GpuBenchmarkItems();
                    $cbi->name = $p->find('.product-name-label')->text();
                    $cbi->value = $p->find('.score-label')->text();
                    $cbi->gpu_benchmark_id = $cb->id;
                    $cbi->save();
                }

            }
        }

        return 0;
    }
}
