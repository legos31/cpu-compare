<?php

namespace app\models;

use yii\base\Model;
use linslin\yii2\curl;
use app\models\Playwright;

class MonkeyParser extends Model
{
    const MORE_CPU_URL = 'https://www.cpu-monkey.com/ajax/cpu_family.php';
    const MORE_BENCHMARK_URL = 'https://www.cpu-monkey.com/ajax/benchmark.php';
    const BASE_URL = 'https://www.cpu-monkey.com/en';
    const BENCHMARK_URL = 'https://www.cpu-monkey.com/en/benchmarks';

    public static function curlRequest($url) {
        $ch = curl_init(trim($url));

        $proxy = '196.17.76.85:8000';
        $proxyauth = 'jVGRev:ukpTpW';

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; rv:38.0) Gecko/20100101 Firefox/38.0');
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $str=curl_exec($ch);

        return $str;
        
    }

    public function getContent($url) {
        $curl = new curl\Curl();
        $response = $curl->get($url);

        //$response = self::curlRequest($url);
        
        // $playWright = new Playwright();
        // $response = $playWright->get($url);
        
        //return \phpQuery::newDocumentHTML($response['content']);
        return \phpQuery::newDocumentHTML($response);
    }

    public function getPostContent($url, $id) {
        $curl = new curl\Curl();
        $response = $curl->setPostParams(['id' => $id])->post($url);

        return \phpQuery::newDocumentHTML($response);
    }

    public static function createAlias($s)
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

    public function getCpuFamilies() {
        $dom = $this->getContent('https://www.cpu-monkey.com/en/cpus');
        //$list = $dom->find('.full_col ul li');
        $list = $dom->find('.full_col a');
        $links = [];
        $i = 1;
        foreach ($list as $li) {
            $pq = pq($li);
            //$links[] = 'https://www.cpu-monkey.com/en/' . $pq->find('a')->attr('href');
            if (($pq->text() != 'back to index') && (27 < $i) && ($i <= 40)) {
                $links[] = 'https://www.cpu-monkey.com/en/' . $pq->attr('href');
            }
            $i++;
            
        }
        return $links;
    }

    public function getCpuLink($tr) {
        $pq = pq($tr);
        $name = $pq->find('td:first a')->text();
        $cpu_link = 'https://www.cpu-monkey.com/en/' . $pq->find('td:first a')->attr('href');
        return [$name, $cpu_link];
    }

    public function showMoreCpu($link) {
        $cpus = [];
        $arr = explode('-', $link);
        $id = array_pop($arr);
        $response = $this->getPostContent(self::MORE_CPU_URL, $id);

        $response->find('table.data tr:first')->remove();
        $trs = $response->find('table.data tr');
        foreach ($trs as $tr) {
            $cpus[] = $this->getCpuLink($tr);
        }
        return $cpus;
    }

    public function parseSpecifications($url) {
        $dom = $this->getContent($url);
        $trs = $dom->find('.cpu_col2 table tr');
        foreach ($trs as $tr) {
            $pq = pq($tr);
            if($pq->find('h2')->text()){
                $pq->find('h2 img')->remove();
                $key = trim($pq->text());
                if(!Specification::find()->where(['name' => $key])->exists()){
                    $sp = new Specification();
                    $sp->name = $key;
                    $sp->save();
                }
            }
        }
    }

    public function showMoreBenchmarks($link) {
        $arr = explode('-', $link);
        $id = array_pop($arr);
        $response = $this->getPostContent(self::MORE_BENCHMARK_URL, $id);

        $response->find('table.data tr:first')->remove();
        return $response->find('table.data tr');
    }

    public function parseBenchmarks() {
        $dom = $this->getContent(self::BENCHMARK_URL);
        $lis = $dom->find('.full_col ul li a');
        $data = [];

        foreach ($lis as $li) {
            $pq = pq($li);
            $data[trim($pq->text())] = 'https://www.cpu-monkey.com/en/' . $pq->attr('href');
        }

        foreach ($data as $key => $item) {
            $page = $this->getContent($item);
            $benchmark = Benchmark::addNew($key, $page);

            $trs = $page->find('.full_col table.data tr');
            $this->saveBenchmarkItems($trs, $benchmark);
            if($page->find('#load_benchmarks')->text()){
                $more_trs = $this->showMoreBenchmarks($item);
                $this->saveBenchmarkItems($more_trs, $benchmark);
            }
        }
    }

    public function saveBenchmarkItems($trs, $benchmark, $cpu) {
        $card_benchmark = CardBenchmark::addNew($cpu->id, $benchmark->id);
        foreach ($trs as $tr) {
            $pq = pq($tr);
            $cpu_name = trim($pq->find('td:eq(1) a')->text());
            CardBenchmarkItems::addNew($cpu_name, $card_benchmark->id, $pq);
        }
    }

    public static function check_url($url){
        $headers = @get_headers($url);
        return $headers && strpos($headers[0], '200');
    }

    public function parseBenchmarksOnPageCpu($dom, $cpu = null) {
        $dom->find('h1, .cpu_data_box, table.vergleich, .werb, br')->remove();
        $full_col = $dom->find('.full_col');
        pq($full_col)->find('h2:eq(0), .verified_benchmarks')->remove();
        $h2s = $full_col->find('h2');
        $benchmarks = [];
        foreach ($h2s as $h2) {
            if (trim(pq($h2)->text()) != 'Popular comparisons' && trim(pq($h2)->text()) != 'Benchmarks' && trim(pq($h2)->text()) != 'Leaderboards') {
                $benchmarks[] = trim(pq($h2)->text());
            }
        }
        
        foreach ($benchmarks as $key => $benchmarkName) {
            $benchmark = Benchmark::find()->where(['name' => $benchmarkName])->one();
            if($benchmark){
                $full_col->find("table:eq({$key}) tr:first")->remove();
                $trs = $full_col->find("table:eq({$key}) tr");
                
                $this->saveBenchmarkItems($trs, $benchmark, $cpu);
            }
        }
    }

    public function parseCpu($url) {
        $dom = $this->getContent($url); 
        
        $cpuDatasBox = $dom->find('.cpu_data_box');
        foreach ($cpuDatasBox as $x=>$data) {
            if ($x != 0) continue;
            
            $blocks =  pq($data);
            $cpuData = $blocks->find('.cpu_data');
            $resData = [];
            foreach ($cpuData as $y=>$block) {
                if ($y == 0) continue;
                
                $cpuDataBlock = pq($block);

                $trs = $cpuDataBlock->find('table tr'); 
            
                foreach ($trs as $tr) {
                    
                    $pq = pq($tr);
                    if ($y == 1) {
                        $groupName = 'CPU generation and family';
                    } else if ($y == 2 || $y == 3) {
                        $groupName = 'CPU Cores and Base Frequency';
                    } else if ($y == 4 || $y == 5) {
                        $groupName = 'Internal Graphics';
                    } else if ($y == 6 || $y == 7) {
                        $groupName = 'Hardware codec support';
                    } else if ($y == 8) {
                        $groupName = 'Memory & PCIe';
                    } else if ($y == 9) {
                        $groupName = 'Thermal Management';
                    } else if ($y == 10 || $y == 11) {
                        $groupName = 'Technical details';
                    }
                    if($pq->find('td')->length == 1) {
                        $pq->find('td')->remove();
                    } else {
                        $resData[$groupName][trim($pq->find('td:eq(0)')->text())] = trim($pq->find('td:eq(1)')->text());
                        //$data[$groupName][trim($pq->find('td:eq(2)')->text())] = trim($pq->find('td:eq(3)')->text());
                    }
                    unset($resData[$groupName]['']);
                }
            }
        }
        
        $card = Card::find()->where(['name' => $resData['CPU generation and family']['Name:']])->one();
        if(!$card) {
            $image = $dom->find('.cpu_img_header img')->attr('src');
            $card = Card::addNew($resData, $url, $image);
            echo $card->id . "\n";

            foreach ($resData as $sp => $items) {
                $specification = Specification::find()->where(['name' => $sp])->one();
                $cpu_spec = CardSpecification::addNew($card->id, $specification->id);
                foreach ($items as $key => $item) {
                    CardSpecificationItems::addNew($key, $item, $cpu_spec->id);
                }
            }
        }
        $this->parseBenchmarksOnPageCpu($dom, $card);
    }

}