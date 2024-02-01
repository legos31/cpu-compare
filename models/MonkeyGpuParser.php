<?php

namespace app\models;

use linslin\yii2\curl;

class MonkeyGpuParser extends MonkeyParser 
{
    const BASE_GPU_URL = 'https://www.gpu-monkey.com/en/';
    const GPU_FAMILY_URL = 'https://www.gpu-monkey.com/en/gpus';
    const SHOW_MORE_GPU_URL = "https://www.gpu-monkey.com/ajax/gpu_group.php";
    const GPU_BENCHMARKS_URL = "https://www.gpu-monkey.com/en/benchmarks";

    public function getGpuFamilies() {
        $dom = $this->getContent(self::GPU_FAMILY_URL);
        echo $dom;
        $list = $dom->find('.full_col a');
        $links = [];
        $i = 1;
        foreach ($list as $a) {
            $links[] = self::BASE_GPU_URL . pq($a)->attr('href');
        }
        return $links;
    }

    public function getGpuLink($tr) {
        $pq = pq($tr);
        $name = trim($pq->find('td:eq(1) a')->text());
        echo $name . "\n";
        $cpu_link = self::BASE_GPU_URL . $pq->find('td:eq(1) a')->attr('href');
        return [$name, $cpu_link];
    }

    public function showMoreGpu($link) {
        $gpus = [];
        $arr = explode('-', $link);
        $id = array_pop($arr);
        $response = $this->getPostContent(self::SHOW_MORE_GPU_URL, $id);

        $response->find('table.data tr:first')->remove();
        $trs = $response->find('table.data tr');
        foreach ($trs as $tr) {
            $gpus[] = $this->getGpuLink($tr);
        }
        return $gpus;
    }

    public function getAllGpus() {
        $links = $this->getGpuFamilies();
        $gpus = [];
        foreach ($links as $link) {
            $family = $this->getContent($link);
            $family = $family->find('#gpu_data_container');
            $family->find('table tr:first')->remove();
            $trs = $family->find('table tr');
            if($trs->length){
                foreach ($trs as $tr) {
                    $gpus[] = $this->getGpuLink($tr);
                }
                $btnMore = $family->find('#load_gpus');
                if($btnMore->text()) {
                    $more_cpus = $this->showMoreGpu($link);
                    $gpus = array_merge($gpus, $more_cpus);
                }
            }
        }

        foreach ($gpus as $gpu) {
            ParsedGpus::addNew($gpu[0], $gpu[1]);
        }
    }

//    --------------------------
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

    public static function saveImage($dom, $gpu_name) {
        $h1 = $dom->find('h1:first')->next();
        $image_url = 'https://www.gpu-monkey.com' . $h1->find('img')->attr('src');
        $path = '/images/gpu/' . self::createAlias($gpu_name) . '.png';
        //if (self::check_url($image_url)) {
        $file = file_get_contents($image_url);
            //$file = self::getImg($image_url);
            //$file = self::curlRequest($image_url);
            file_put_contents(__DIR__ . "/../web" . $path, $file);
        //}
        return $path;
    }

    public static function getImg($url) {
        $curl = new curl\Curl();
        $response = $curl->get($url);
    }

    public static function parseGpuSpecifications($dom, $gpu) {
        $dom->find('br, h2, div[id], .banner_div, .werb, .vergleich')->remove();
        $tables = $dom->find('table.datadyn');
        $data = [];

        foreach ($tables as $table) {
            $first_row = pq($table)->find('tr:first')->remove();
            //$col1 = Specification::addNew(trim($first_row->find('td:first')->text()));
            $col1 = Specification::addNew(trim($first_row->find('h3')->text()));
            
            $col2 = Specification::addNew(trim($first_row->find('td:last')->text()));
            $col2 = $col2 ? $col2 : $col1;
            
            $trs = pq($table)->find('tr');
            foreach ($trs as $tr) {
                $pq = pq($tr);
                $data[$col1->name][trim($pq->find('td:eq(0)')->text())] = trim($pq->find('td:eq(1)')->text());
                //$data[$col2->name][trim($pq->find('td:eq(2)')->text())] = trim($pq->find('td:eq(3)')->text());
            }
        }
        
        return $data;
    }

    public function parseGpu() {
        $gpus = ParsedGpus::find()->where(['is_new' => 1])->all();
        $i = 1;
        foreach ($gpus as $gpu) {
            if ($i > 5) exit;
            $dom = $this->getContent($gpu->url);
            $full_col = $dom->find('.full_col');
            $image = self::saveImage($full_col, $gpu->name);
            $specs = self::parseGpuSpecifications($full_col, $gpu);
            $newGpu = Gpu::addNew($gpu, $specs, $image);
            echo $gpu->name . "\n";

            foreach ($specs as $spec => $items) {
                $specification = Specification::find()->where(['name' => $spec])->one();
                $gs = GpuSpecification::addNew($newGpu->id, $specification->id);

                foreach ($items as $item => $value) {
                    GpuSpecificationItems::addNew($item, $value, $gs->id);
                }
            }
            ParsedGpus::parsed($gpu);
            $i++;
        }
    }

    public function getAllBenchmarks() {
        $dom = $this->getContent(self::GPU_BENCHMARKS_URL);
        $lis = $dom->find('.full_col ul li a');
        $data = [];

        foreach ($lis as $li) {
            $pq = pq($li);
            $data[trim($pq->text())] = self::BASE_GPU_URL . $pq->attr('href');
        }
        foreach ($data as $key => $item) {
            $page = $this->getContent($item);
            Benchmark::addNew($key, $page);
        }
    }

    public function saveGpuBenchmarkItems($trs, $benchmark, $cpu) {
        $card_benchmark = GpuBenchmark::addNew($cpu->id, $benchmark->id);
        foreach ($trs as $tr) {
            $pq = pq($tr);
            GpuBenchmarkItems::addNew($card_benchmark->id, $pq);
        }
    }

    public function parseGpuBenchmarks() {
        $gpus = Gpu::find()->where(['is_new' => 1])->all();
        foreach ($gpus as $gpu) {
            $dom = $this->getContent($gpu->source_url);
            $dom->find('.full_col br, .full_col>table, h1, .banner_div, .gpu_data_box')->remove();
            $h3s = $dom->find('.full_col h3');
            echo $gpu->id . "\n";
            $arrBench = [
                '3DMark Benchmark - Fire Strike Extreme Graphics score', '3DMark Benchmark - Time Spy Extreme Graphics score',
                '3DMark Benchmark - Port Royal (Raytracing)', '3DMark Benchmark - Speed Way Graphics Score (Raytracing)',
                'Cyberpunk 2077 - 2560x1440 (1440p)', 'Cyberpunk 2077 - 1920x1080 (1080p)',
                'Battlefield 5 - 2560x1440 (1440p)', 'Battlefield 5 - 1920x1080 (1080p)',
                'GTA 5 Benchmark (Grand Theft Auto V) - 2560x1440 (1440p)', 'GTA 5 Benchmark (Grand Theft Auto V) - 1920x1080 (1080p)',
                'Shadow of the Tomb Raider - 2560x1440 (1440p)', 'Shadow of the Tomb Raider - 1920x1080 (1080p)',
               ];
            foreach ($h3s as $key => $h3) {
                $benchOnMonkey =  trim(pq($h3)->text());
                if (in_array($benchOnMonkey, $arrBench)) continue;
                $b_name = explode(' - ', trim(pq($h3)->text()))[0];
                //echo $b_name. PHP_EOL; continue;
                $benchmark = Benchmark::find()->where(['name' => $b_name])->one();
                if($benchmark){
                    $dom->find(".full_col>div[id]:eq({$key}) table tr:first")->remove();
                    $trs = $dom->find("div.benchmark_table:eq({$key}) tr");
                    $this->saveGpuBenchmarkItems($trs, $benchmark, $gpu);
                }
            } 
            Gpu::parsed($gpu->id);
        }
        echo 'ready';
    }
}