<?php
namespace app\models;

class Playwright {
    const SCRIPTS_PATH = ''; // путь до папки с js файлами

    public static function get(string $url)
    {
        //proxy
        $proxy = implode(' ', [
            'server' => '45.153.20.235:14697',
            'username' => 'rSYcHt',
            'password' => '5gW8BU',
        ]);

        $scriptName = 'getPage.js';  //js файл
        $command = "node $scriptName " . escapeshellarg($url) . " $proxy";
        //$command = "node $scriptName " . escapeshellarg($url);
        $result = shell_exec($command);

        $result = json_decode($result, true);
        if (!$result) {
            print_r('json decode error');
            exit;
        } elseif (isset($result['error'])) {
            print_r($result['error']);
            exit;
        } elseif (!($result['content'])) {
            print_r('пустой content');
            exit;
        }
        //вернет массив html и COOKIE
        return $result;
    }
}
