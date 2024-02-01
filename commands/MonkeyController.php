<?php

namespace app\commands;

use app\models\Card;
use app\models\Compare;
use app\models\Gpu;
use app\models\Languages;
use app\models\MonkeyGpuParser;
use app\models\MonkeyParser;
use app\models\ParsedCpus;
use yii\console\Controller;
use Yii;

class MonkeyController extends Controller {

    public function createAlias($s) {
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

    public function actionCpus() {
        $monkeyParser = new MonkeyParser();
        $links = $monkeyParser->getCpuFamilies();
        $cpus = [];

        foreach ($links as $link) {
            $family = $monkeyParser->getContent($link);
            $family->find('table.data:eq(1) tr:first')->remove();
            $trs = $family->find('table.data:eq(1) tr');
            foreach ($trs as $tr) {
                $cpus[] = $monkeyParser->getCpuLink($tr);
            }
            $btnMore = $family->find('#load_cpus');
            if($btnMore->text()) {
                $more_cpus = $monkeyParser->showMoreCpu($link);
                $cpus = array_merge($cpus, $more_cpus);
            }
        }
        foreach ($cpus as $cpu) {
            ParsedCpus::addNew($cpu[0], $cpu[1]);
        }
        echo 'done!';
        return 0;
    }

    public function actionCpu() {
        $monkeyParser = new MonkeyParser();
        $cpus = ParsedCpus::find()->where(['is_new' => 1])->all();
        $i = 1;
        foreach ($cpus as $cpu) {
            if ($i > 5) exit;
            try {
                $monkeyParser->parseCpu($cpu->url);
                ParsedCpus::parsed($cpu);
            } catch (\Exception $e) {}
            $i++;
        }

    }

    public function actionCpuBenchmarks() {
        $dom = '';
        $monkeyParser = new MonkeyParser();
        $cpus = Card::find()->where(['is_new' => 1])->all();

        foreach ($cpus as $cpu) {
            $monkeyParser->parseBenchmarksOnPageCpu($dom, $cpu);
            Card::parsed($cpu->id);
        }
    }

    // public function actionCompare() {
    //     $cards = Card::find()->all();
    //     for($i = 0; $i < count($cards) - 1; $i++){
    //         try {
    //             $compare = new Compare();
    //             $compare->card_1 = $cards[$i]->id;
    //             $compare->card_2 = $cards[$i+1]->id;
    //             $compare->category_id = 1;
    //             $compare->counter = 1;
    //             $compare->date = time();
    //             $compare->url = '/cpu/compare/' . $cards[$i]->alias . '-vs-' . $cards[$i+1]->alias;
    //             $compare->save();
    //         } catch (\Exception $e){}
    //     }
    // }

    public function actionGpus() {
        
        $monkeyParser = new MonkeyGpuParser();
        //$monkeyParser->getAllGpus();
        $monkeyParser->parseGpu();
    }

    public function actionGpuBenchmarks() {
        $monkeyParser = new MonkeyGpuParser();
        $monkeyParser->parseGpuBenchmarks();
    }

    //карта сайта для карточек товаров
    public function actionMap(){
        $host = 'https://cpu-compare.com';
        $cpus = Card::find()->select('alias')->column();
        $gpus = Gpu::find()->select('alias')->column();
        //$compares = Compare::find()->where(['not', ['url' => null]])->select('url')->column();

        $languages = Languages::find()->select('code')->column();

        foreach ($languages as $language) {
            $map = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $map .= '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">';
            $map .= '<url><loc>' . $host . ($language != 'en' ? '/' . $language : '') . '</loc><changefreq>daily</changefreq><priority>1</priority></url>';
            $map .= '<url><loc>' . $host . ($language != 'en' ? '/' . $language : '') . '/cpu/list</loc><changefreq>daily</changefreq><priority>0.8</priority></url>';
            $map .= '<url><loc>' . $host . ($language != 'en' ? '/' . $language : '') . '/gpu/list</loc><changefreq>daily</changefreq><priority>0.8</priority></url>';

            foreach ($cpus as $url){
                $map .= '<url><loc>' . $host . ($language != 'en' ? '/' . $language : '') . '/cpu/' . $url .'</loc><changefreq>daily</changefreq><priority>0.3</priority></url>';
            }

            foreach ($gpus as $url){
                $map .= '<url><loc>' . $host . ($language != 'en' ? '/' . $language : '') . '/gpu/' . $url .'</loc><changefreq>daily</changefreq><priority>0.3</priority></url>';
            }
            $map .= '</urlset>';

            $file = __DIR__ . "/../web/sitemaps/{$language}/sitemap-{$language}.xml";
		    echo $file;

            if(!file_exists($file)){
                $fh = fopen($file, 'w') or die("Can't create file");
                fclose($fh);
            }
            $dom = new \DOMDocument();
            $dom->preserveWhiteSpace = FALSE;
            $dom->loadXML($map);
            $dom->save($file);
            //$gz_file = __DIR__ . "/../web/sitemaps/sitemap-{$language}.xml.gz";
            //file_put_contents("compress.zlib://{$gz_file}", file_get_contents($file));
        }
        exit();
    }

    //карта сайта для сравнений
    public function actionMapCompare(){
        ini_set('memory_limit', '2000M');
        $host = 'https://cpu-compare.com';
        $compares = Compare::find()->where(['not', ['url' => null]])->select('url')->column();
                
        $languages = Languages::find()->select('code')->column();

        $map = '';
        $count = 0;
        foreach ($languages as $language) {
            $prName = 1;
            $totalCount = count($compares);

            $fileMain = __DIR__ . "/../web/sitemaps/{$language}/sitemap-index-{$language}.xml";
            $mapMain = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $mapMain .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            $mapMain .= '<sitemap>';
            $homeUrl = "https://cpu-compare.com/sitemaps/{$language}/";
            $mapMain .= "<loc>{$homeUrl}sitemap-{$language}.xml</loc>";
            $dateMod = date('c', time());
            $mapMain .= "<lastmod>{$dateMod}</lastmod>";
            $mapMain .= '</sitemap>';
            
            foreach ($compares as $url){
                $map .= '<url><loc>' . $host . ($language != 'en' ? '/' . $language : '') . $url .'</loc><changefreq>daily</changefreq><priority>0.3</priority></url>';
                $count ++;
                $totalCount --;
                if ($count == 49990) {
                    $this->createFile($map,$prName,$language);
                    $map = '';
                    $mapMain .= '<sitemap>';
                    $homeUrl = "https://cpu-compare.com/sitemaps/{$language}/";
                    $mapMain .= "<loc>{$homeUrl}sitemap-compare-{$language}-{$prName}.xml</loc>";
                    $dateMod = date('c',time());
                    $mapMain .= "<lastmod>{$dateMod}</lastmod>";
                    $mapMain .= '</sitemap>';
                    // $mapMain .= '<sitemap>';
                    // $mapMain .= "<loc>{$homeUrl}sitemap-compare-{$prName}.xml.gz</loc>";
                    // $mapMain .= "<lastmod>{$dateMod}</lastmod>";
                    // $mapMain .= '</sitemap>';
                    $count = 0;
                    $prName ++;
                } else {
                    if ($totalCount == 0) {
                        $this->createFile($map, $prName, $language);
                        $map = '';
                        $mapMain .= '<sitemap>';
                        $homeUrl = "https://cpu-compare.com/sitemaps/{$language}/";
                        $mapMain .= "<loc>{$homeUrl}sitemap-compare-{$language}-{$prName}.xml</loc>";
                        $dateMod = date('c', time());
                        $mapMain .= "<lastmod>{$dateMod}</lastmod>";
                        $mapMain .= '</sitemap>';
                    }
                }
            }
            $mapMain .= '</sitemapindex>';
            if (!file_exists($fileMain)) {
                $fh = fopen($fileMain, 'w') or die("Can't create file");
                fclose($fh);
            }
            $dom = new \DOMDocument();
            $dom->preserveWhiteSpace = FALSE;
            $dom->loadXML($mapMain);
            $dom->save($fileMain);
        }
        
        // $gz_file = __DIR__ . "/../web/sitemaps/sitemap-main.xml.gz";
        // file_put_contents("compress.zlib://{$gz_file}", file_get_contents($fileMain));
        exit();
    }

    private function createFile($mapUrl,$prName,$language) {
        $map = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $map .= '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">';
        $map .= $mapUrl;
        $map .= '</urlset>';

        $file = __DIR__ . "/../web/sitemaps/{$language}/sitemap-compare-{$language}-{$prName}.xml";
        echo $file;

        if(!file_exists($file)){
            $fh = fopen($file, 'w') or die("Can't create file");
            fclose($fh);
        }
        $dom = new \DOMDocument();
        $dom->preserveWhiteSpace = FALSE;
        $dom->loadXML($map);
        $dom->save($file);
        // $gz_file = __DIR__ . "/../web/sitemaps/sitemap-compare-{$prName}.xml.gz";
        // file_put_contents("compress.zlib://{$gz_file}", file_get_contents($file));
    }

    public function actionUnic()
    {
        ini_set('memory_limit', '2000M');
        $compares = Compare::find()->all();
        foreach ($compares as $compare) {
            // $unic = Compare::find()
            // ->where(['url' => $compare->url])
            // ->all();
            // if (count($unic) > 1) {
            //     echo $compare->url;
            // }

            $compareAll = Compare::find()
            ->where(['category_id' => 1, 'card_1' => $compare->card_1, 'card_2' => $compare->card_2])
            ->orWhere(['category_id' => 1, 'card_1' => $compare->card_2, 'card_2' => $compare->card_1])
                ->all();

                if (count($compareAll) > 1) {
                    echo '!!!';
                }
        }

        echo 'done';
    }

}